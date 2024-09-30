<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

Use App\Models\Slider;
Use App\Models\Social;
Use App\Models\Feature;
Use App\Models\Service;
Use App\Models\CountryVisa;
Use App\Models\AboutUs;
Use App\Models\ChooseUs;
Use App\Models\Faq;
Use App\Models\Testimonial;
Use App\Models\Brand;
Use App\Models\Blog;
Use App\Models\Appointment;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {       
        $slider_items = Slider::where('status', 1)->latest()->get();
        $social_items = Social::where('status', 1)->latest()->get();
        $feature_items = Feature::where('status', 1)->latest()->get();
        $feature_items = Feature::where('status', 1)->latest()->get();
        $country_items = CountryVisa::where('status', 1)->latest()->get();
        $service_items = Service::where('status', 1)->latest()->get();
        $about_page = AboutUs::where('status', 1)->first();
        $choose_us = ChooseUs::where('status', 1)->get();
        $faq_items = Faq::where('status', 1)->get();
        $testimonial_items = Testimonial::where('status', 1)->get();
        $brand_items = Brand::where('status', 1)->get();
        $blog_items = Blog::where('status', 1)->get();
        return view('frontend.home.index', compact('slider_items','social_items','feature_items','service_items','country_items','about_page','choose_us','faq_items','testimonial_items','brand_items','blog_items'));
    }

    public function service_details($service_id){
        $item = Service::find($service_id);
        $social_items = Social::where('status', 1)->latest()->get();
        return view('frontend.service.index', compact('item','social_items'));
    }

    public function about_page() {
        $item = AboutUs::first();
        $social_items = Social::where('status', 1)->latest()->get();
        return view('frontend.about.index', compact('item','social_items'));
    }

    public function make_appointment(Request $request){           
        Appointment::create([
            'name'  => $request->name,
            'phone'  => $request->phone,
            'country'  => $request->country,
            'service'  => $request->service,
            'date'  => $request->appoint_date,
            'time'  => $request->time
        ]);
        return redirect()->back();
    }

    public function contact_us(){
        $social_items = Social::where('status', 1)->latest()->get();
        return view('frontend.contact.index', compact('social_items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
