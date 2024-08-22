<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CrowdFund;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Cloudinary\Cloudinary;

class CrowdfundController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('crowdfund.create', compact('categories'));
    }

    public function store(Request $request, Cloudinary $cloudinary)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'duration' => 'required|date',
            'goal' => 'required|numeric',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'short_story' => 'required|string',
            'story' => 'required|string',
        ]);

        // Upload image to Cloudinary
        $uploadedImage = $cloudinary->uploadApi()->upload($request->file('image')->getRealPath(), [
            'folder' => 'crowdfund_images'
        ]);

        $imageUrl = $uploadedImage['secure_url'];

        // Create and save the Crowdfund instance
        $crowdfund = new CrowdFund();
        $crowdfund->user_id = Auth::id();
        $crowdfund->name = $request->input('name');
        $crowdfund->category_id = $request->input('category_id');
        $crowdfund->duration = $request->input('duration');
        $crowdfund->goal = $request->input('goal');
        $crowdfund->image = $imageUrl;
        $crowdfund->short_story = $request->input('short_story');
        $crowdfund->story = $request->input('story');
        $crowdfund->save();

        return redirect()->route('home')->with('success', 'Crowdfund created successfully!');
    }

    public function show($id)
    {
        $crowdfund = CrowdFund::findOrFail($id);
        $categories = Category::all();

        return view('project', compact('crowdfund', 'categories'));
    }
    public function showAll()
    {
        $crowdfunds = CrowdFund::all();
        $categories = Category::all();

        return view('project', compact('crowdfunds', 'categories'));
    }

    public function raiseFund(Request $request, $id)
    {
        // Find the crowdfund or fail with a 404 error
        $crowdfund = CrowdFund::findOrFail($id);

        // Validate the raise input
        $request->validate([
            'raise' => 'required|numeric|min:1',
        ]);

        // Debugging logs
        \Log::info('Raising funds for crowdfund ID: ' . $id);
        \Log::info('Current raised amount: ' . $crowdfund->raised);
        \Log::info('Amount to raise: ' . $request->input('raise'));

        // Add the raise value to the current raised amount
        $crowdfund->raised += $request->input('raise');
        
        // Ensure people_count column exists
        if ($crowdfund->isDirty('people_count')) {
            $crowdfund->people_count = $crowdfund->people_count ?? 0;
        }
        
        // Increment the people_count by 1
        $crowdfund->people_count += 1;

        // Check if the goal is reached
        if ($crowdfund->raised >= $crowdfund->goal) {
            $crowdfund->is_complete = true;
        }

        // Update the crowdfund record in the database
        $crowdfund->save();

        // Redirect back to the project page with a success message
        return redirect()->route('crowdfund.show', $id)->with('success', 'Funds raised successfully!');
    }

    public function update(Request $request, $id)
    {
        $crowdfund = CrowdFund::findOrFail($id);

        // Ensure only the owner can update
        if (auth()->id() !== $crowdfund->user_id) {
            return redirect()->route('crowdfund.show', $id)->with('error', 'You are not authorized to update this project.');
        }

        // Validation logic
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'short_story' => 'required|string',
            'story' => 'required|string',
            'goal' => 'required|numeric',
            'duration' => 'required|date',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Update the crowdfund project
        $crowdfund->update($validatedData);

        return redirect()->route('crowdfund.show', $id)->with('success', 'Project updated successfully.');
    }


    public function destroy($id)
    {
        $crowdfund = CrowdFund::findOrFail($id);

        // Ensure only the owner can delete
        if (auth()->id() !== $crowdfund->user_id) {
            return redirect()->route('crowdfund.show', $id)->with('error', 'You are not authorized to delete this project.');
        }

        $crowdfund->delete();

        return redirect()->route('home')->with('success', 'Project deleted successfully.');
    }
}