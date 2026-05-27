<!DOCTYPE html>
<html>
<head>
    <title>Reviews</title>
</head>
<body>

<h1>Daftar Review</h1>

<table border="1" cellpadding="10">
    <tr>
        <th>User</th>
        <th>Product</th>
        <th>Rating</th>
        <th>Comment</th>
        <th>Action</th>
    </tr>

    @foreach($reviews as $review)
    <tr>
        <td>{{ $review->user->name }}</td>
        <td>{{ $review->product->name }}</td>
        <td>{{ $review->rating }}</td>
        <td>{{ $review->comment }}</td>

        <td>
            @if(Auth::check() && Auth::user()->role == 'admin')
                <form action="{{ route('reviews.destroy', $review->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" onclick="return confirm('Hapus review ini?')">
                        Delete
                    </button>
                </form>
            @endif
        </td>
    </tr>
    @endforeach

</table>

</body>
</html>