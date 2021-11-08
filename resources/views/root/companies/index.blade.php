@extends('layouts.root')

@section('content')




<div class="main-panel">
  <div class="content-wrapper">
    <div class="row" style="margin-left: 1.0rem; margin-right: 1.0rem; margin-bottom: 10px;">
      <div class="col-md-6">
        <span class="material-icons-outlined icon-header" style="font-size: 3.0rem; color: #ffffff; padding: 0.6rem; background: #10425E; border-radius: 0.4rem;">category</span> 
      </div>
      <div class="col-md-6" style="padding-top: 10px;">
        <a href="{{url('root/companies/create')}}" class=" btn btn-sm btn-success float-right">
          <span class="material-icons-outlined">add</span>
        </a>
      </div>
    </div>
    <div class="row" >



      <div class="col-lg-12 grid-margin stretch-card">
              <div class="card" style="border-bottom: 5px solid #82A448; margin: 0px;">
                <div class="card-body">
                  
                  <div class="sortable table-responsive">
                    <table class="sortable table table-striped">
                      <thead>
                        <tr>
                          <th>
                            logo
                          </th>
                          <th>
                            company
                          </th>
                          <th>
                            courses
                          </th>
                          <th>
                            users
                          </th>
                          
                        </tr>
                      </thead>
                      <tbody>

                        @foreach($companies as $company)
                        <tr>
                          <td class="py-1">
                            <img style="border-radius: 0px; width: auto;" src="{{url('content/logos/'.$company->logo)}}"/>
                          </td>
                          <td>
                            {{$company->name}}
                          </td>
                          <td>
                          {{$company->courses->count()}}
                          </td>
                          <td>
                          {{$company->users->count()}}
                          </td>

                          <!-- <td>
                            <div class="dropdown">
                              <a class="btn btn-sm btn-link !dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="material-icons">more_horiz</span>
                              </a>

                              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item " href="{{url('root/companies/'.$company->id.'/edit')}}">
                                  <span class="material-icons">edit</span>
                                </a>
                                <br/>
                                <a class="dropdown-item " href="#">
                                  <span class="material-icons">visibility</span>
                                </a>
                              </div>
                            </div>
                          </td> -->
                          
                        </tr>
                        @endforeach
                      </tbody>
                    </table>

                    {!! $companies->links() !!}
                  </div>
                </div>
              </div>
            </div>
      




    </div>
  </div>
  
</div>




@endsection