<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Tickets</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h1 class="mb-4">All Support Tickets</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table id="ticket-table" class="table table-striped table-bordered">
        <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Subject</th>
            <th>Message</th>
            <th>Type</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tickets as $ticket)
            <tr>
                <td>{{ $ticket->id }}</td>
                <td>{{ $ticket->subject }}</td>
                <td>{{ ($ticket->message) }}</td>
                <td>{{ ($ticket->source) }}</td>
                <td>{{ $ticket->status }}</td>
                <td>
                    <a href="{{ url("/admin/tickets/{$ticket->id}/{$ticket->source}") }}" class="btn btn-primary btn-sm">View</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <form method="POST" action="{{ route('Logout') }}">
            @csrf
            <button type="submit">Logout</button>
    </form>
</div>

<!-- jQuery, Bootstrap JS, DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
        $('#ticket-table').DataTable();
    });
</script>