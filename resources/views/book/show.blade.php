@extends('layouts.app')

@section('template_title')
    {{ $book->name ?? "{{ __('Show') Book" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Book</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('books.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Title:</strong>
                            {{ $book['title'] }}
                        </div>
                        <div class="form-group">
                            <strong>Author:</strong>
                            {{ $book['author'] }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
