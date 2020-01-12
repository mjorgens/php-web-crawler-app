@extends('app')

@section('title', 'Url Crawler')

@section('form')
    <h3 class="display-4 text-center">Enter url to crawl</h3>
    <form id="form" role="form" method="post" action="/">
        @csrf
        <div class="row">
            <div class="col">
                <label for="website" class="col-form-label">Website to crawl: </label>
                <input type="text" class="form-control @error('website') is-invalid @enderror" name="website"
                       value="https://" required>
            </div>
            <div class="col">
                <label for="max" class="col-form-label">Max limit: </label>
                <input type="number" class="form-control @error('max') is-invalid @enderror" name="max" value="5"
                       min="0" max="60">
            </div>
        </div>
        <div class="row justify-content-end m-2">
            <button type="submit" class="btn btn-primary">Crawl it!</button>
        </div>
    </form>
@endsection

@section('results')
    <h3 class="display-4 text-center">Last Pages Crawled</h3>
    <div class="align-content-center">
        @isset($pages)
            <ol>
                @foreach($pages as $page)
                    <li>{{ $page->url }}</li>
                @endforeach
            </ol>
        @endisset
    </div>
@endsection
