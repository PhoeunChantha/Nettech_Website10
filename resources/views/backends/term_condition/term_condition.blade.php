@extends('backends.master')
@section('contents')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3>{{ __('Term & Condition') }}</h3>
                </div>
                <div class="col-sm-6" style="text-align: right">
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.update-term') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <textarea class="form-control summernote-term-condition" name="term_condition" id="term_condition" cols="30"
                                rows="10">{{ old('term_condition', $term_condition) }}</textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row p-2 ml-2">
                            <button type="submit" class="btn btn-primary float-start">{{ __('Save') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('.summernote-term-condition').summernote({
                height: 400,
            });
        });
    </script>
@endpush