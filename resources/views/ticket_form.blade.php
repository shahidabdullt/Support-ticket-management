<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit a Support Ticket</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            padding: 40px;
        }
        .ticket-form {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="d-flex min-vh-100 align-items-center justify-content-center bg-light">
    <div class="container d-flex flex-column align-items-center">
        <div class="ticket-form card p-4 shadow-lg" style="max-width: 30rem; width: 100%;">
            <h3 class="mb-4 text-center">Submit a Support Ticket</h3>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form method="POST" action="/ticket/store">
                @csrf

                <div class="mb-3">
                    <label for="type" class="form-label">Ticket Type</label>
                    <select name="type" id="type" class="form-select @error('type') is-invalid @enderror" required>
                        <option value="">-- Select Ticket Type --</option>
                        <option value="technical">Technical Issues</option>
                        <option value="billing">Account & Billing</option>
                        <option value="product">Product & Service</option>
                        <option value="general">General Inquiry</option>
                        <option value="feedback">Feedback & Suggestions</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="subject" class="form-label">Subject</label>
                    <input type="text" name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror" required>
                    @error('subject')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea name="message" id="message" rows="4" class="form-control @error('message') is-invalid @enderror"></textarea>
                    @error('message')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary w-100">Submit Ticket</button>
                </div>
            </form>
        </div>

        <!-- Home Button Below the Form -->
        <a href="/" class="btn btn-outline-primary mt-3">Home</a>
    </div>
</body>

</html>
