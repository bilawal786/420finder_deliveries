@extends('layouts.admin')

    @section('content')
   
        <div class="panel panel-headline">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="panel-title">Other Store Locations</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
          <div class="col-md-4">

            <div class="panel panel-headline">
                <div class="panel-body">
                  
                  <form action="{{ route('storelocation') }}" method="POST">
                    @csrf
                    <input type="hidden" name="retailer_id" value="{{ session('business_id') }}">
                    <div class="form-group">
                      <label for="">Store Name</label>
                      <input type="text" name="store_name" placeholder="Enter Store Name" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <label for="">Enter Location</label>
                        <input id="searchTextField" type="text" size="50" placeholder="Enter a location" class="form-control" autocomplete="on" runat="server" required="" />  
                        <input type="hidden" id="city2" name="location" />
                        <input type="hidden" id="cityLat" name="latitude" />
                        <input type="hidden" id="cityLng" name="longitude" />
                    </div>
                    <div class="form-group">
                      <button class="btn btn-dark">Create</button>
                    </div>
                  </form>
                  
                </div>
            </div>

          </div>
          <div class="col-md-8">

            <div class="panel panel-headline">
                <div class="panel-body">
                  
                  <div class="table responsive">
                    <table class="table">
                      <thead>
                        <th>#</th>
                        <th>Store Name</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                      </thead>
                      <tbody>
                        @if($locations->count() > 0)
                          @foreach($locations as $index => $location)
                            <tr>
                              <td>{{ $index + 1 }}</td>
                              <td>
                                {{ $location->store_name }}<br>
                                <a href="{{ route('deletelocation', ['id' => $location->id]) }}" onclick="return confirm('Are you sure you want to delete this location?');">Delete</a>
                              </td>
                              <td>{{ $location->latitude }}</td>
                              <td>{{ $location->longitude }}</td>
                              <td>{{ $location->created_at->diffForHumans() }}</td>
                              <td>{{ $location->updated_at->diffForHumans() }}</td>
                            </tr>
                          @endforeach
                        @else

                        @endif
                      </tbody>
                    </table>
                  </div>
                  
                </div>
            </div>

          </div>
        </div>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrAR67o9XfYUXH6u66iVXYhqsOzse6Uz8&libraries=places"></script>
    <script>
        function initialize() {
          var input = document.getElementById('searchTextField');
          var autocomplete = new google.maps.places.Autocomplete(input);
            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                var place = autocomplete.getPlace();
                // console.log(place);
                document.getElementById('city2').value = place.name;
                document.getElementById('cityLat').value = place.geometry.location.lat();
                document.getElementById('cityLng').value = place.geometry.location.lng();
            });
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    @endsection
