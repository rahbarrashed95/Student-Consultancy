@extends('backend.partials.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h3 class="mt-4"> Membership  </h3>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">{{ __('staff.Dashboard') }}</a></li>
            <li class="breadcrumb-item active">Membership Update </li>
        </ol>

        <div class="card mb-4">
            
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        
                        <form action="{{route('admin.memberships.update',[$item->id])}}" method="POST" id="ajax_form">
                          @csrf
                          @method('PATCH')
                          <div class="row">
                                <div class="col-sm-6">
                                <div class="form-group">
                                      <label>Membership ID (empty for auto generate)</label>
                                        <input type="text" name="member_id" value="{{ $item->member_id}}" class="form-control">
                                  </div>
                                </div>
                              <div class="col-sm-6">
                                  <div class="form-group">
                                      <label>Membership Type </label>
                                        <select class="form-control" name="type_id">
                                          <option value=""> {{ __('staff.Select') }}</option>
                                            @foreach($types as $type)
                                            <option value="{{$type->id}}" {{$type->id==$item->type_id ?'selected':''}}>{{ $type->name}}</option>
                                            @endforeach
                                        </select>
                                  </div>
                              </div>

                              <div class="col-md-6 mb-2">
                                  <div class="form-group">
                                      <strong > Name</strong>
                                      <input type="text" class="form-control" name="name" value="{{ $item->name}}" placeholder="Name">
                                  </div>
                              </div>

                              <div class="col-md-6 mb-2">
                                  <div class="form-group">
                                      <strong > {{ __('staff.Address') }} </strong>
                                      <textarea class="form-control" name="address"> {{ $item->address}} </textarea>
                                  </div>
                              </div>

                              <div class="col-md-6 mb-2">
                                  <div class="form-group">
                                      <strong >Tel</strong>
                                      <input type="text" class="form-control" name="home_tel" value="{{ $item->home_tel}}" placeholder="Enter Phone...">
                                  </div>
                              </div>

                              <div class="col-md-6 mb-2">
                                  <div class="form-group">
                                      <strong >Mobile</strong>
                                      <input type="text" class="form-control" name="phone" value="{{ $item->phone}}" placeholder="Enter Phone...">
                                  </div>
                              </div>

                              <div class="col-md-6 mb-2">
                                  <div class="form-group">
                                      <strong> Fax </strong>
                                      <input type="text" class="form-control" name="fax" value="{{ $item->fax}}" placeholder="Enter fax...">
                                  </div>
                              </div>

                              <div class="col-md-6 mb-2">
                                  <div class="form-group">
                                      <strong >{{ __('staff.Email') }}</strong>
                                      <input type="mail" class="form-control" name="email" value="{{ $item->email}}" placeholder="Enter Email...">
                                  </div>
                              </div>

                              
                              <div class="col-md-6 mb-2">
                                  <div class="form-group">
                                      <strong> Occupation </strong>
                                      <input type="text" class="form-control" name="occupation" value="{{ $item->occupation}}" placeholder="Enter Occupation...">
                                  </div>
                              </div>

                              <div class="col-md-6 mb-2">
                                  <div class="form-group">
                                      <strong> Designation </strong>
                                      <input type="text" class="form-control" name="designation" value="{{ $item->designation}}" placeholder="Enter Designation...">
                                  </div>
                              </div>

                              <div class="col-md-12 mb-2">
                                  <div class="form-group">
                                      <strong> Name Of Organization </strong>
                                      <input type="text" class="form-control" name="organization_name" value="{{ $item->organization_name}}" placeholder="Organization Name...">
                                  </div>
                              </div>

                              <div class="col-md-8 mb-2">
                                  <div class="form-group">
                                      <strong> Address (office) </strong>
                                      <textarea class="form-control" name="office_address">{{ $item->office_address}}</textarea>
                                  </div>
                              </div>

                              <div class="col-md-4 mb-2">
                                  <div class="form-group">
                                      <strong > Tel (office)</strong>
                                      <input type="text" class="form-control" name="office_tel" value="{{ $item->office_tel}}">
                                  </div>
                              </div>

                              <div class="col-md-4 mb-2">
                                  <div class="form-group">
                                      <strong > Date Of Birth </strong>
                                      <input type="date" class="form-control" name="dob" value="{{ $item->dob}}">
                                  </div>
                              </div>

                              <div class="col-md-4 mb-2">
                                  <div class="form-group">
                                      <strong> Place Of Birth </strong>
                                      <textarea class="form-control" name="birth_place">{{ $item->birth_place}}</textarea>
                                  </div>
                              </div>

                              <div class="col-md-4 mb-2">
                                  <div class="form-group">
                                      <strong> Nationality </strong>
                                      <textarea class="form-control" name="nationality">{{ $item->nationality}}</textarea>
                                  </div>
                              </div>

                                <div class="col-md-4 mb-2">
                                    <div class="form-group">
                                        <strong> Aim Of Membership </strong>
                                        <select class="form-control select2" name="aim_member">
                                            <option value="0"> Select One </option>
                                            @foreach(getAims() as $key=>$aim)
                                            <option value="{{$key}}" {{$key==$item->aim_member ?'selected':''}}> {{$aim}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-2">
                                  <div class="form-group">
                                      <strong> Entry DAte  </strong>
                                      <input type="date" class="form-control" name="start_at" value="{{ $item->start_at}}">
                                  </div>
                                </div>
                                
                                
                                <div class="col-md-4 mb-2">
                                  <div class="form-group">
                                      <strong> Expired at </strong>
                                      <input type="date" class="form-control" name="expired_at" value="{{ $item->expired_at}}">
                                  </div>
                                </div>

                              <div class="col-md-8 offset-md-2 d-none">
                                  <table class="table table-bordered table-striped table-hover">
                                      <tr>
                                        <th> Have you for any reason been unable to exercise in the past? </th>
                                        <th> 
                                            <div class="form-check">
                                              <input class="form-check-input" type="checkbox" value="1" id="past" name="reason_past">
                                              <label class="form-check-label" for="past">
                                                Yes
                                              </label>
                                            </div>
                                        </th>
                                      </tr>

                                      <tr>
                                        <th> Have your physician ever advised you against exercise? </th>
                                        <th> 
                                            <div class="form-check">
                                              <input class="form-check-input" type="checkbox" value="1" id="advised" name="advised">
                                              <label class="form-check-label" for="advised">
                                                Yes
                                              </label>
                                            </div>
                                        </th>
                                      </tr>

                                      <tr>
                                        <th> Have you ever suffered from any cardiac (Heart) related disease ? </th>
                                        <th> 
                                            <div class="form-check">
                                              <input class="form-check-input" type="checkbox" value="1" id="cardiac_issue" name="cardiac_issue">
                                              <label class="form-check-label" for="cardiac_issue">
                                                Yes
                                              </label>
                                            </div>
                                        </th>
                                      </tr>

                                      <tr>
                                        <th> Have you ever suffered from respiratory difficules ? </th>
                                        <th> 
                                            <div class="form-check">
                                              <input class="form-check-input" type="checkbox" value="1" id="ever_suffer" name="ever_suffer">
                                              <label class="form-check-label" for="ever_suffer">
                                                Yes
                                              </label>
                                            </div>
                                        </th>
                                      </tr>

                                      <tr>
                                        <th> Have you ever suffered from fainting, migraine or loss of balance ? </th>
                                        <th> 
                                            <div class="form-check">
                                              <input class="form-check-input" type="checkbox" value="1" id="suffer_fainting" name="suffer_fainting">
                                              <label class="form-check-label" for="suffer_fainting">
                                                Yes
                                              </label>
                                            </div>
                                        </th>
                                      </tr>

                                      <tr>
                                        <th> Have you ever suffered from any bone, joint, or muscle related disease ? </th>
                                        <th> 
                                            <div class="form-check">
                                              <input class="form-check-input" type="checkbox" value="1" id="suffer_join" name="suffer_join">
                                              <label class="form-check-label" for="suffer_join">
                                                Yes
                                              </label>
                                            </div>
                                        </th>
                                      </tr>

                                      <tr>
                                        <th> Is there any history of heart disease in your family ? </th>
                                        <th> 
                                            <div class="form-check">
                                              <input class="form-check-input" type="checkbox" value="1" id="family_history" name="family_history">
                                              <label class="form-check-label" for="family_history">
                                                Yes
                                              </label>
                                            </div>
                                        </th>
                                      </tr>

                                      <tr>
                                        <th> Do you have high/low blood pressure ? </th>
                                        <th> 
                                            <div class="form-check">
                                              <input class="form-check-input" type="checkbox" value="1" id="blood_pressure" name="blood_pressure">
                                              <label class="form-check-label" for="blood_pressure">
                                                Yes
                                              </label>
                                            </div>
                                        </th>
                                      </tr>

                                      <tr>
                                        <th> Have you experienced Chest pain whilst exercising ? </th>
                                        <th> 
                                            <div class="form-check">
                                              <input class="form-check-input" type="checkbox" value="1" id="pain_when_exercise" name="pain_when_exercise">
                                              <label class="form-check-label" for="pain_when_exercise">
                                                Yes
                                              </label>
                                            </div>
                                        </th>
                                      </tr>

                                      <tr>
                                        <th> Do you have elevated cholesterol levels ? </th>
                                        <th> 
                                            <div class="form-check">
                                              <input class="form-check-input" type="checkbox" value="1" id="blood_pressure" name="blood_pressure">
                                              <label class="form-check-label" for="blood_pressure">
                                                Yes
                                              </label>
                                            </div>
                                        </th>
                                      </tr>


                                  </table>
                              </div>




                                <div class="col-md-4 mb-2">
                                    <img src="{{ getImage('memberships',$item->image)}}" width="80">
                                    <div class="form-group">
                                        <strong > {{ __('staff.Image') }} </strong>
                                        <input type="file" class="form-control" name="image">
                                    </div>
                                </div>

                                <div class="col-md-4 mb-2">
                                    <img src="{{ getImage('memberships',$item->nid_image)}}" width="80">
                                    <div class="form-group">
                                        <strong > NID </strong>
                                        <input type="file" class="form-control" name="nid_image">
                                    </div>
                                </div>
                                
                                <div class="col-md-4 mb-2">
                                    <img src="{{ getImage('memberships',$item->nid_image_2)}}" width="80">
                                    
                                    <div class="form-group">
                                        
                                        <strong > NID Back</strong>
                                        <input type="file" class="form-control" name="nid_image_2">
                                    </div>
                                </div>
                                
                                <div class="col-md-4 mb-2">
                                    <div class="form-group">
                                        <strong> Status </strong>
                                        <select class="form-control" name="status">
                                            <option value="1" {{'1'==$item->status ?'selected':''}}> Active </option>
                                            <option value="0" {{'0'==$item->status ?'selected':''}}> De-Active </option>
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                          <input type="submit" value="{{ __('staff.Save') }}" class="btn btn-success">
                          <hr>
                      </form>

                    </div>
                </div>
                
            </div>
        </div>
    </div>
</main>
                
@endsection

