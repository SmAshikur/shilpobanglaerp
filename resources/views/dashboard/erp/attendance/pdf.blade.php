<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Attendance Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #1e293b; margin: 0; padding: 20px; }
        h1 { font-size: 20px; font-weight: 900; color: #1e293b; margin: 0 0 4px; }
        p.sub { font-size: 11px; color: #64748b; margin: 0 0 20px; }
        table { width: 100%; border-collapse: collapse; }
        thead tr { background: #4f46e5; color: #fff; }
        thead th { padding: 10px 12px; text-align: left; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: .05em; }
        tbody tr:nth-child(even) { background: #f8fafc; }
        tbody td { padding: 9px 12px; border-bottom: 1px solid #e2e8f0; }
        .badge { display: inline-block; padding: 2px 8px; border-radius: 9999px; font-size: 9px; font-weight: 700; text-transform: uppercase; }
        .present  { background: #d1fae5; color: #065f46; }
        .absent   { background: #fee2e2; color: #991b1b; }
        .late     { background: #fef3c7; color: #92400e; }
        .leave    { background: #dbeafe; color: #1e40af; }
        .half_day { background: #ede9fe; color: #5b21b6; }
        .footer { margin-top: 24px; font-size: 10px; color: #94a3b8; text-align: right; }
    </style>
</head>
<body>
    <h1>Attendance Report</h1>
    <p class="sub">Generated on {{ now()->format('d M Y, h:i A') }} &nbsp;|&nbsp; Total Records: {{ $attendances->count() }}</p>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Employee</th>
                <th>Date</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Break</th>
                <th>Net Work</th>
                <th>Status</th>
                <th>Note</th>
            </tr>
        </thead>
        <tbody>
            @forelse($attendances as $i => $a)
                @php
                    $net = '—';
                    if ($a->check_in && $a->check_out) {
                        $mins = \Carbon\Carbon::parse($a->check_in)->diffInMinutes(\Carbon\Carbon::parse($a->check_out));
                        $netM = max(0, $mins - ($a->break_minutes ?? 0));
                        $net  = intdiv($netM,60).'h '.($netM%60).'m';
                    }
                @endphp
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td><strong>{{ $a->employee->name ?? '—' }}</strong></td>
                    <td>{{ \Carbon\Carbon::parse($a->date)->format('M d, Y') }}</td>
                    <td>{{ $a->check_in  ? \Carbon\Carbon::parse($a->check_in)->format('h:i A')  : '—' }}</td>
                    <td>{{ $a->check_out ? \Carbon\Carbon::parse($a->check_out)->format('h:i A') : '—' }}</td>
                    <td>{{ $a->break_minutes ? $a->break_minutes.' min' : '—' }}</td>
                    <td>{{ $net }}</td>
                    <td><span class="badge {{ $a->status }}">{{ ucfirst(str_replace('_',' ',$a->status)) }}</span></td>
                    <td>{{ $a->note ?? '' }}</td>
                </tr>
            @empty
                <tr><td colspan="9" style="text-align:center;padding:20px;color:#94a3b8;">No records found.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">Shilpobangla ERP — Confidential</div>
</body>
</html>
