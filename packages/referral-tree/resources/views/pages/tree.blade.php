@extends('layouts.app')

@section('title', 'User Referral Tree')


@section('content')
<link href="{{asset('assets/css/tree.css')}}" rel="stylesheet" type="text/css">
<div class="row">

    <div class="col-lg-12 col-md-12 layout-spacing">
        
         <div class="treeview js-treeview">
            <ul>
              <li data-id="{{ $user->id }}" id="user-li-{{ $user->id }}">
                <div class="treeview__level" data-level="0">
                  <span class="level-title"> {{ $user->first_name }} {{ $user->last_name }}</span>
                  <div class="treeview__level-btns">
                    <div class="level-show"  data-id="{{ $user->id }}" ><span class="flaticon-arrow-down"></span></div>
                    <div class="level-hide hidden"  data-id="{{ $user->id }}" ><span class="flaticon-arrow-up"></span></div>
                  </div>
                </div>
                <ul id="child-{{ $user->id }}"></ul>
              </li>
            </ul>
          </div>

    </div>
          
          <template id="levelMarkup">
            <li data-id="" id="user-li">
                <div class="treeview__level" data-level="A">
                  <span class="level-title"></span>
                  <div class="treeview__level-btns">
                    <div class="level-show"  data-id="0"><span class="flaticon-arrow-down"></span></div>
                    <div class="level-hide hidden"  data-id="0" ><span class="flaticon-arrow-up"></span></div>
                  </div>
                </div>
                <ul>
                </ul>
            </li>
          </template>


    </div>

</div>
<div class="loading">Loading&#8230;</div>
<script src="{{asset('assets/js/tree.js')}}"></script>
@endsection