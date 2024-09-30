@extends('backend.partials.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">{{ __('faq.Faq List') }} </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="">{{ __('faq.Dashboard') }}</a></li>
            <li class="breadcrumb-item active"> {{ __('faq.Faq List') }} </li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                {{ __('faq.Manage Faq') }} 

                @if(auth()->user()->can('faq.create'))
                <a href="{{ route('admin.faqs.create',['type'=>'faq'])}}" class="btn btn-primary btn-sm btn_modal">
                        {{ __('faq.Faq Add') }}
                </a>
                @endif
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>{{ __('faq.Sl') }}</th>
                                        <th>{{ __('faq.Question') }}</th>                                                                                                     
                                        <th>{{ __('faq.Answer') }}</th>                                                                                                     
                                        <th style="width: 125px;">{{ __('slider.Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $key=>$item)
                                    <tr>                                      
                                    
                                        <td> {{$key+1}}</td>
                                        <td> {{$item->question}}</td>                                                                        
                                        <td> {{$item->answer}}</td>                                                                        
                                        <td>
                                            @can('social.edit')
                                            <a href="{{ route('admin.faqs.edit',[$item->id])}}" class="btn-sm btn_modal btn btn-primary"> 
                                                <i class="fa fa-edit "></i></a>
                                            @endcan
                                            @can('social.delete')
                                                <a href="{{ route('admin.faqs.destroy',[$item->id])}}" class="delete btn-sm btn btn-danger"> 
                                                    <i class="fa fa-trash "></i></a>
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                        </div>

                    </div>
                </div>
                
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
                
@endsection

