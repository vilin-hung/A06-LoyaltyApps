@extends('layouts.app')

@section('content')
<div class="container">
    <h1>My Favorites</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($favorites as $favorite)
                <tr>
                    <td>{{ $favorite->product->name }}</td>
                    <td>
                        <form action="{{ route('favorites.destroy', $favorite->product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger">
                                Remove
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">
                        Belum ada produk favorit
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection