<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Ticket #{{ $ticket->id }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Trix CSS (or CKEditor CSS if using CKEditor) -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css">
</head>
<body>
<div class="container my-5">
    <h1 class="mb-4">Ticket Details (#{{ $ticket->id }})</h1>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Subject</h5>
            <p class="card-text">{{ $ticket->subject }}</p>

            <h5 class="card-title">Message</h5>
            <p class="card-text">{{ $ticket->message }}</p>

            <h5 class="card-title">Type</h5>
            <p class="card-text">{{ $type }}</p>

            <h5 class="card-title">Status</h5>
            <p class="card-text">{{ $ticket->status }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Add Note</div>
        <div class="card-body">
            <form method="POST" action="/admin/tickets/{{$ticket->id}}/{{$type}}/note" onsubmit="return validateNote();">
                @csrf
                <div class="mb-3">
                    <input id="note_content" type="hidden" name="note" required>
                    <trix-editor input="note_content" required></trix-editor>
                    <div class="text-danger mt-1" id="note-error" style="display:none;">Note is required.</div>
                </div>
                <button type="submit" class="btn btn-success">Save Note</button>
            </form>
        </div>
    </div>

    <a href="/ticketlist" class="btn btn-secondary mt-3">Back to List</a>
</div>

<!-- JS includes -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
<script>
    function validateNote() {
        const note = document.querySelector('#note_content').value.trim();
        if (note === '') {
            document.querySelector('#note-error').style.display = 'block';
            return false;
        }
        document.querySelector('#note-error').style.display = 'none';
        return true;
    }
</script>
</body>
</html>
   