<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <thead class="table-light">
            <tr>
                <th>ID</th> 
                <th>Type</th>
                <th width="200">Name</th>
                <th>Designation</th>
                <th>Occupation</th>
                <th>Nationality</th>
                <th>{{ __('staff.Email') }}</th>
                <th>{{ __('staff.Phone') }}</th>
                <th>Date Of Birth</th>
                <th>Entry Date</th>
                <th>Expired At</th>
                <th>{{ __('staff.Image') }}</th>
                <th>Status</th>

                <th style="width: 125px;">{{ __('staff.Action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $key=>$item)
            <tr>
                <td> {{$item->member_id}}</td>
                <td> {{$item->type?$item->type->name:''}}</td>
                <td> {{$item->name}}</td>
                <td> {{$item->designation}}</td>
                <td> {{$item->occupation}}</td>
                <td> {{$item->nationality}}</td>
                <td> {{$item->email}}</td>
                <td> {{$item->phone}}</td>
                <td> {{$item->dob}}</td>
                <td> {{$item->start_at}}</td>
                <td> {{$item->expired_at}}</td>
                <td>
                    <img src="{{ getImage('memberships',$item->image)}}" width="80">
                </td>
                <td> {{$item->status=='1'?'Active':'de-active'}}</td>
                
                <td>
                    @can('memberships.view')
                    <a href="{{ route('admin.memberships.show',[$item->id])}}" class="action-icon"> 
                        <i class="fa fa-eye"></i></a>
                    @endcan
                    
                    @can('memberships.edit')
                    <a href="{{ route('admin.memberships.edit',[$item->id])}}" class="action-icon"> 
                        <i class="fa fa-edit"></i></a>
                    @endcan
                    @can('memberships.delete')
                        <a href="{{ route('admin.memberships.destroy',[$item->id])}}" class="delete action-icon"> 
                            <i class="fa fa-trash"></i></a>
                    @endcan

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
</div>
<p>{!! urldecode(str_replace("/?","?",$items->appends(Request::all())->render())) !!}</p>