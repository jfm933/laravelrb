@extends('layouts.app')

@section('template_title')
    Book
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Book') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('books.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Title</th>
										<th>Author</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($books as $id => $book)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $book['title'] }}</td>
        <td>{{ $book['author'] }}</td>

        <td>
            <form action="{{ route('books.destroy', $id) }}" method="POST">
                <a class="btn btn-sm btn-primary " href="{{ route('books.show', $id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                <a class="btn btn-sm btn-success" href="{{ route('books.edit', $id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
            </form>
        </td>
    </tr>
@endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endsection
