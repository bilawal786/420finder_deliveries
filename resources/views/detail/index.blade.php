@extends('layouts.admin')

    @section('content')

        <div class="panel panel-headline">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="panel-title">Detail</h3>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <form action="{{ route('detail.update', session('business_id')) }}" method="POST" enctype="multipart/form-data">

                    @method('PUT')
                    @csrf

                    <div class="form-group">
                        <label for="" style="margin-bottom: 1rem;font-size: 1.7rem">Introduction</label>
                        <textarea name="introduction" id="" rows="8" class="form-control summernote">{{ !is_null($detail) && !is_null($detail->introduction) ? $detail->introduction : '' }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="" style="margin-bottom: 1rem;font-size: 1.7rem">About Us</label>
                        <textarea name="about" id="" rows="8" class="form-control summernote">{{ !is_null($detail) && !is_null($detail->about) ? $detail->about : '' }}</textarea>
                    </div>

                    {{-- <div class="form-group">
                        <label for="" style="margin-bottom: 1rem;font-size: 1.7rem">Amenities</label>
                        <div>
                            <input type="checkbox" name="brand_verified"
                            <?php
                            // if(isset($detail)) {
                            //     $amenities = json_decode($detail->amenities, true);
                            //     if($amenities['brand_verified'] == 'on') {
                            //         echo 'checked';
                            //     }
                            // }
                            ?>
                            >
                            <span>Brand Verified</span>
                        </div>

                        <div>
                            <input type="checkbox" name="access"
                            <?php
                            // if(isset($detail)) {
                            //     $amenities = json_decode($detail->amenities, true);
                            //     if($amenities['access'] == 'on') {
                            //         echo 'checked';
                            //     }
                            // }
                            ?>
                            > <span>Accessible</span>
                        </div>

                        <div>
                            <input type="checkbox" name="security"
                            <?php
                            // if(isset($detail)) {
                            //     $amenities = json_decode($detail->amenities, true);
                            //     if($amenities['security'] == 'on') {
                            //         echo 'checked';
                            //     }
                            // }
                            ?>
                            > <span>Security</span>
                        </div>
                    </div> --}}

                    <div class="form-group">
                        <label for="" style="margin-bottom: 1rem;font-size: 1.7rem">First-Time Customers</label>
                        <textarea name="customers" id="" rows="8" class="form-control summernote">{{ !is_null($detail) && !is_null($detail->customers) ? $detail->customers : '' }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="" style="margin-bottom: 1rem;font-size: 1.7rem">Announcement</label>
                        <textarea name="announcement" id="" rows="8" class="form-control summernote">{{ !is_null($detail) && !is_null($detail->announcement) ? $detail->announcement : '' }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="" style="margin-bottom: 1rem;font-size: 1.7rem">State License</label>
                        <textarea name="license" id="" rows="8" class="form-control summernote">{{ !is_null($detail) && !is_null($detail->license) ? $detail->license : '' }}</textarea>
                    </div>

                    <div class="form-group">
                        <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                    </div>
                </form>

            </div>
        </div>

    @endsection

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
      $('.summernote').summernote({
          height: 200
      });
    });
</script>

@endsection
