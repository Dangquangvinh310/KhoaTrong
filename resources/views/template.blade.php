@extends('master')
@section('main-content')
<div class="row">
    <div class="col-12">
        <div class="card">
        <h5 class="card-header">Custom file input</h5>
        <div class="card-body demo-vertical-spacing demo-only-element">
            <div class="input-group">
            <label class="input-group-text" for="inputGroupFile01">Upload</label>
            <input type="file" class="form-control" id="inputGroupFile01" />
            </div>

            <div class="input-group">
            <input type="file" class="form-control" id="inputGroupFile02" />
            <label class="input-group-text" for="inputGroupFile02">Upload</label>
            </div>

            <div class="input-group">
            <button class="btn btn-outline-primary" type="button" id="inputGroupFileAddon03">Button</button>
            <input
                type="file"
                class="form-control"
                id="inputGroupFile03"
                aria-describedby="inputGroupFileAddon03"
                aria-label="Upload"
            />
            </div>

            <div class="input-group">
            <input
                type="file"
                class="form-control"
                id="inputGroupFile04"
                aria-describedby="inputGroupFileAddon04"
                aria-label="Upload"
            />
            <button class="btn btn-outline-primary" type="button" id="inputGroupFileAddon04">Button</button>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection