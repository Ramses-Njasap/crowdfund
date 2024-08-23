@extends('layout.base')

@section('content')

<style>
    .detail {
        font-family: 'Poppins';
    }
</style>

<script src="https://cdn.tiny.cloud/1/z0tjfyc19bx62zx1blg9yjkkrg6p35w0cwf30qgxhrv4tf8e/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

<div class='w-100 detail'>
    <div class='w-100 d-flex flex-row flex-wrap justify-content-center' style='padding-top: 8rem; background: #f7f7f9; padding-left: 7vw; padding-right: 7vw;'>
        <div class='w-50 d-flex flex-column justify-content-center px-3'>
            <img src="{{ $crowdfund->image }}" alt="Crowdfund Image" style='height: 480px; width: 100%'>
            <h2 class='h2 display-3 font-weight-bold text-left mt-5'>
                SHORT STORY
            </h2>
            <div>
                {!! $crowdfund->short_story !!}
            </div>
        </div>
        <div class='w-50 px-3'>
            <div class='d-flex flex-row align-items-center'>
                <div class='btn border-0 rounded-0 px-4 mr-3' style='background: #674df0;'>
                    {{ $crowdfund->category->name }}
                </div>
                <div>
                    @auth
                    @if (Auth::id() === $crowdfund->user_id)
                    <i class="fas fa-edit" data-toggle="modal" data-target="#editCrowdfundModal"></i>
                    @endif
                    @endauth
                </div>
            </div>
            <h1 class="h4 display-4 font-weight-bold mt-3">
                {{ $crowdfund->name }}
            </h1>
            <div class="d-flex flex-row flex-wrap mt-1">
                <div class='bg-white text-center m-2 d-flex flex-column justify-content-center align-items-center px-5' style='max-width: 300.39px; height: 138.59px'>
                    <div class='h3'>
                        XAF {{ $crowdfund->raised ?? 0 }}
                    </div>
                    <div>
                        Raised
                    </div>
                </div>
                <div class='bg-white text-center m-2 d-flex flex-column justify-content-center align-items-center px-5' style='max-width: 300.39px; height: 138.59px'>
                    <div class='h3'>
                        {{ $crowdfund->people_count }}
                    </div>
                    <div>
                        People
                    </div>
                </div>
                <div class='bg-white text-center m-2 d-flex flex-column justify-content-center align-items-center px-3' style='max-width: 300.39px; height: 138.59px'>
                    <div class='h3'>
                        {{ $crowdfund->formatted_duration }}
                    </div>
                    <div>
                        days left
                    </div>
                </div>
            </div>
            <div class='mt-3'>
                <span>Raised: {{$crowdfund->percentageRaised()}} % 
                <span class="badge {{ $crowdfund->is_complete ? 'badge-success' : 'badge-secondary' }}">
                    {{ $crowdfund->is_complete ? 'Complete' : 'Incomplete' }}
                </span>
                </span>
                <div class="progress my-1" style='height: 10px'>
                    <div class="progress-bar bg-dark" role="progressbar" style="width: {{$crowdfund->percentageRaised()}}%; height: 10px;" aria-valuenow="{{$crowdfund->percentageRaised()}}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <span class="font-weight-bold fs-3">Goal: </span> <span class='fs-3' style='color: #29f0b4'>XAF {{ number_format($crowdfund->goal) }}</span>
            </div>
            <div>
                @auth
                <!-- All authenticated users can raise funds -->
                <div class='d-flex flex-row flex-wrap align-items-center mt-4'>
                    <form action="{{ route('crowdfund.raiseFund', $crowdfund->id) }}" method="POST" style="display: inline;">
                        {!! csrf_field() !!}
                        @method('PATCH')
                        <div class='d-flex flex-row flex-wrap align-items-center'>
                            <div>
                                <input type="number" id='raise' name='raise' class='form-control' style='width: 200px' placeholder='Amount' />
                            </div>
                            <div class='ml-2'>
                                <button type="submit" class="btn btn-primary btn-primary" style='background: #674df0;'>Raise Funds</button>
                            </div>
                        </div>
                    </form>
                    
                    @if (Auth::id() === $crowdfund->user_id)
                    <!-- If user is owner, user can delete crowdfund -->
                    <form action="{{ route('crowdfund.destroy', $crowdfund->id) }}" method="POST" style="display: inline;" class='ml-3'>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Project</button>
                    </form>
                    @endif
                </div>
                @endauth
                @guest
                    <!-- Prompt guest users to log in -->
                    <div class='d-flex flex-row flex-wrap align-items-center mt-4'>
                        <p class="mr-2">Please <a href="{{ route('login') }}" class='text-primary'>log in</a> to raise funds or interact with this project.</p>
                    </div>
                @endguest
            </div>
        </div>
    </div>

    <div class='w-100 d-flex flex-row flex-wrap justify-content-center' style='padding-left: 7vw; padding-right: 7vw;'>
        <div style='width: 60%'>

            <h2 class='h2 display-3 font-weight-bold text-left mt-5' style='text-align: justify'>
                STORY
            </h2>

            {!! $crowdfund->story !!}
        </div>
        <div style='width: 40%'></div>
    </div>
</div>


<!-- Edit Crowdfund Modal -->
@auth
<div class="modal fade" id="editCrowdfundModal" tabindex="-1" role="dialog" aria-labelledby="editCrowdfundModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCrowdfundModalLabel">Edit Crowdfund</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('crowdfund.update', $crowdfund->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Crowdfund Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ $crowdfund->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category_id" id="category" class="form-control" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @if($crowdfund->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="duration">Duration</label>
                        <input type="datetime-local" id="duration" name="duration" class="form-control" value="{{ $crowdfund->duration}}" required>
                    </div>
                    <div class="form-group">
                        <label for="goal">Goal</label>
                        <input type="number" id="goal" name="goal" class="form-control" value="{{ $crowdfund->goal }}" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" id="image" name="image" class="form-control" onchange="previewImage(event)">
                        <img id="imagePreview" class="image-preview" src="{{ $crowdfund->image }}" alt="Image Preview" style="display:block;">
                    </div>
                    <div class="form-group">
                        <label for="short_story">Short Story</label>
                        <textarea id="short_story" name="short_story" class="form-control" rows="5" required>{{ $crowdfund->short_story }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="story">Story</label>
                        <textarea id="story" name="story" class="form-control" rows="10" required>{{ $crowdfund->story }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Crowdfund</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endauth

@endsection
