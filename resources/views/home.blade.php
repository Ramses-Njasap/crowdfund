@extends('layout.base')

@section('content')
<!-- Custom CSS -->
<style>
        .hero-section {
            background: url('https://via.placeholder.com/1920x600') no-repeat center center/cover;
            color: #fff;
            min-height: 80vh;
            display: flex;
            align-items: center;
            position: relative;
            margin-top: 85px;
            padding-left: 20%;
            padding-top: 30px;
            padding-bottom: 30px;
            width: 100%; /* Ensures the section takes up the full viewport width */
            margin-left: calc(50% - 50vw); /* Centers the section and makes sure it stretches across the full viewport */
            font-family: 'Poppins';
        }
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6); /* Overlay to darken the image */
            z-index: 1;
        }
        .hero-content {
            position: relative;
            z-index: 2;
            display: flex;
            width: 100%;
        }
        .hero-content .caption {
            width: 50%;
        }
        .fs-1 {
            font-size: 5.5rem;
            font-weight: 700;
        }
        .fs-2 {
            font-size: 3.5rem;
        }
        .fs-3 {
            font-size: 1.25rem;
        }
        .hero-content .btn-primary {
            font-size: 1.2rem;
            padding: 10px 30px;
            border: 1px solid #343a40;
            /* border-radius: 50px; */
            background-color: #29f0b4;
            transition: background-color 0.3s ease;
        }
        .hero-content .btn-primary:hover {
            background-color: #343a40;
        }

        .top-category {
            color: #f8f9fa;
            background: #674df0;
            padding: 50px 8.5vw 50px;
            font-family: 'Poppins';
            color: #838694;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
        }

        .w-50 {
            width: 50%;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .top-category-content {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
        }

        .top-category-container {
            border: 2px solid green;
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .top-category-word {
            font-family: 'Poppins', sans-serif;
        }

        .top-category-item {
            margin: 5px;
            box-sizing: border-box;
            text-align: center;
            padding: 10px;
            background-color: #fff;
            border: 1px solid #ccc;
            width: 190.78px;
            height: 170.66px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
        }
        .top-category-item span {
            color: #1b1f2e;
            font-size: 1.2rem;
        }
        .top-category-item i {
            color: #674df0;
            /* margin-bottom: auto; */
            margin: auto;
        }
        .top-category span {
            margin-top: auto;
        }
        .category-tag {
            background: #674df0;
        }
    </style>

    <!-- Hero Section -->
    <section class="hero-section justify-content-start text-left">
        <div class="hero-content">
            <div class='caption'>
                <span class='fs-3'>Raising Money Has Never Been Easy</span>
                <h1 class='fs-1'>We Help Surface Imagination To Reality</h1>
                <a href="#" class="btn btn-primary p-4">Crowdfund That Imagination</a>
            </div>
        </div>
    </section>

    <!-- Funding Category -->
    <div class="top-category d-flex flex-row flex-wrap justify-content-center">
        <div class="w-50">
            <span class='fs-3'>
                Which Category Interests You?
            </span>
            <h1 class="fs-2 mt-2 text-white display-1 font-weight-bold top-category-word">
                Top Categories
            </h1>
            <span class='fs-3 mt-2'>
            Lorem Ipsum is simply dummy text of the printing and typesetting industry.

Lorem Ipsum has been the industry's standard dummy text ever since the when an unknown was popularised.
            </span>

            <div class='mt-4 d-flex flex-row' style='border-left: 10px solid #29f0b4;'>
                <div class="border-white p-1 ml-5 rounded-circle d-flex text-center border-white" style='height: 74px; width: 74px; border: 1.5px solid #fff;'>
                    <img src="https://images.unsplash.com/photo-1706885093476-b1e54f3b7496?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1yZWxhdGVkfDJ8fHxlbnwwfHx8fHw%3D"
                        class="rounded-circle border-sm" alt="https://via.placeholder.com/370x220" height='100%' width='100%'>
                </div>
            </div>
        </div>
        <div class='w-50 top-category-content'>
            <div class='top-category-item'>
                <i class="fa-regular fa-hospital fs-2" aria-hidden="true"></i><br/>
                <span class="fs-6">Health Care</span>
            </div>
            <div class="top-category-item">
                <i class="fa-solid fa-microchip fs-2"></i>
                <span class="fs-6">Technology</span>
            </div>
            <div class="top-category-item">
                <i class="fa-solid fa-book fs-2"></i>
                <span class="fs-6">Education</span>
            </div>
            <div class="top-category-item">
                <i class="fa-solid fa-business-time fs-2"></i>
                <span class="fs-6">Business</span>
            </div>
            <div class="top-category-item">
                <i class="fa-solid fa-plane-departure fs-2"></i>
                <span class="fs-6">Travel</span>
            </div>
            <div class="top-category-item">
                <i class="fa-solid fa-house fs-2"></i>
                <span class="fs-6">Rent</span>
            </div>
        </div>
    </div>

    <div class='mx-auto w-75'>
        <div>
            Ready To Raise Funds For Idea?
        </div>
        <div></div>
    </div>

    <div class='d-flex flex-row flex-wrap justify-content-center align-items-center' style='margin: 7rem 15rem 7rem'>
        @foreach($crowdfunds as $crowdfund)
        <div class="card m-2" style="width: 22rem;">
            <img class="card-img-top" src="{{ $crowdfund->image }}" alt="https://via.placeholder.com/370x220" style='height: 200px; width: 100%'>
            <div class="card-body">
                <div class='d-flex flex-row align-items-center px-2'>
                    <div class='category-tag btn border-0 rounded-0 px-4'>
                        {{ $crowdfund->category->name }}
                    </div>
                    <div class='ml-2' style='font-size: 1.3rem'>
                        {{ $crowdfund->formatted_duration }}
                    </div>
                </div>
                <div class='mx-2 my-2'>
                    <a class='h3 display-7 font-weight-bold' href="{{ route('crowdfund.show', $crowdfund->id) }}">
                        {{ \Illuminate\Support\Str::limit($crowdfund->name, 30, '...') }}
                    </a>
                </div>
                <div class="progress" style='height: 10px'>
                    <div class="progress-bar bg-dark" role="progressbar" style="width: {{$crowdfund->percentageRaised()}}%; height: 10px;" aria-valuenow="{{$crowdfund->percentageRaised()}}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
@endsection