@extends('backend.partials.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h3 class="mt-4"> Membership Details</h3>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">{{ __('staff.Dashboard') }}</a></li>
            <li class="breadcrumb-item active"> {{ $item->name }}</li>
        </ol>

        <div class="card mb-4">
            
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <lable> Member Id </lable>
                        <p> {{ $item->member_id}}</p>
                    </div>
                    
                    <div class="col-md-3">
                        <lable> Name </lable>
                        <p> {{ $item->name}}</p>
                    </div>
                    
                    <div class="col-md-3">
                        <lable> Type </lable>
                        <p> {{ $item->type?$item->type->name:''}}</p>
                    </div>
                    
                    <div class="col-md-3">
                        <lable> Designation </lable>
                        <p> {{ $item->designation}}</p>
                    </div>
                    
                    <div class="col-md-3">
                        <lable> occupation </lable>
                        <p> {{ $item->occupation}}</p>
                    </div>
                    
                    <div class="col-md-3">
                        <lable> nationality </lable>
                        <p> {{ $item->nationality}}</p>
                    </div>
                    
                    <div class="col-md-3">
                        <lable> email </lable>
                        <p> {{ $item->email}}</p>
                    </div>
                    
                    <div class="col-md-3">
                        <lable> Mobile </lable>
                        <p> {{ $item->phone}}</p>
                    </div>
                    
                    <div class="col-md-3">
                        <lable> Fax </lable>
                        <p> {{ $item->fax}}</p>
                    </div>
                    
                    <div class="col-md-3">
                        <lable> Name Of Organization </lable>
                        <p> {{ $item->organization_name}}</p>
                    </div>
                    
                    <div class="col-md-3">
                        <lable> Address (office) </lable>
                        <p> {{ $item->office_address}}</p>
                    </div>
                    
                    <div class="col-md-3">
                        <lable> Tel (office) </lable>
                        <p> {{ $item->office_tel}}</p>
                    </div>
                    
                    <div class="col-md-3">
                        <lable> Date Of Birth </lable>
                        <p> {{ $item->dob}}</p>
                    </div>
                    
                    <div class="col-md-3">
                        <lable> Place Of Birth </lable>
                        <p> {{ $item->birth_place}}</p>
                    </div>
                    <div class="col-md-3">
                        <lable> Nationality </lable>
                        <p> {{ $item->nationality}}</p>
                    </div>
                    <div class="col-md-3">
                        <lable> Aim Of Membership </lable>
                        <p> {{ getAims()[$item->aim_member]}}</p>
                    </div>
                    <div class="col-md-3">
                        <lable>Entry Date </lable>
                        <p> {{ $item->start_at}}</p>
                    </div>
                    
                    <div class="col-md-3">
                        <lable>Expired at </lable>
                        <p> {{ $item->expired_at}}</p>
                    </div>
                    
                    <div class="col-md-3">
                        <lable>Image  </lable>
                        <img src="{{ getImage('memberships',$item->image)}}" width="150">
                    </div>
                    
                    <div class="col-md-3">
                        <lable>NID Front  </lable>
                        <img src="{{ getImage('memberships',$item->nid_image)}}" width="150">
                    </div>
                    <div class="col-md-3">
                        <lable>NID Back  </lable>
                        <img src="{{ getImage('memberships',$item->nid_image_2)}}" width="150">
                    </div>
                    
                    
                </div>
                
                <hr>
                <div class="row mt-2">
                    <div class="col-sm-12">
                        <h3> Payment List</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>{{ __('staff.Sl') }}</th> 
                                        <th>Date</th>
                                        <th>Member Name</th>
                                        <th>Member Phone</th>
                                        <th>Method</th>
                                        <th>Amount</th>
                                        <th>Note</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($item->payments as $key=>$pay)
                                    <tr>
                                        <td> {{$key+1}}</td>
                                        <td> {{dateFormate($pay->date)}}</td>
                                        <td> {{$pay->membership?$pay->membership->name:''}}</td>
                                        <td> {{$pay->membership?$pay->membership->phone:''}}</td>
                                        
                                        <td> {{$pay->method}}</td>
                                        <td> {{$pay->amount}}</td>
                                        
                                        <td> {{$pay->note}}</td>
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
                
@endsection

@push('js')

@endpush