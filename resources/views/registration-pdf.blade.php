<!DOCTYPE html>
<html>
<head>
    <title>Registration Document Check</title>
    <style>
        body { font-family: sans-serif; color: #333; padding: 20px; }
        h2 { color: #1e3a8a; border-bottom: 2px solid #e5e7eb; padding-bottom: 10px; }
        .data-box { margin-top: 20px; background: #f9fafb; padding: 15px; border-radius: 5px; }
        .row { margin-bottom: 12px; font-size: 14px; }
        .label { font-weight: bold; color: #4b5563; display: inline-block; width: 150px; }
    </style>
</head>
<body>
    <h2>Wizard Onboarding Registration Copy</h2>
    <p>Generated dynamically on: {{ now()->toFormattedDateString() }}</p>

    <div class="data-box">
        <div class="row"><span class="label">Username:</span> {{ $username }}</div>
        <div class="row"><span class="label">Company Name:</span> {{ $company_name }}</div>
        <div class="row"><span class="label">Business Type:</span> {{ $business_type }}</div>
        <div class="row"><span class="label">Terms Accepted:</span> {{ $terms_accepted ? 'Yes' : 'No' }}</div>
    </div>
</body>
</html>
