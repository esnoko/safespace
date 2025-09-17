<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Admin Dashboard - SafeSpace</title>
    <style>
        /* Reset & Base Styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', Arial, sans-serif;
            background: #f9fafb;
            color: #222;
            line-height: 1.6;
        }

        .dashboard-container {
            max-width: 900px;
            margin: 40px auto;
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
        }

        h2 {
            color: #059669;
            margin-bottom: 2rem;
            font-size: 1.8rem;
        }

        .logout-btn {
            background: #ef4444;
            color: #fff;
            border: none;
            padding: 0.5rem 1.2rem;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            float: right;
        }

        .logout-btn:hover {
            background: #dc2626;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 2rem;
        }

        th, td {
            padding: 0.75rem;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
            vertical-align: top;
        }

        th {
            background: #f3f4f6;
            font-weight: 600;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .dashboard-container {
                margin: 20px 10px;
                padding: 1.5rem;
            }

            h2 {
                font-size: 1.5rem;
            }

            .logout-btn {
                float: none;
                width: 100%;
                margin-bottom: 1rem;
                display: block;
                text-align: center;
            }
        }

        @media (max-width: 600px) {
            table, th, td {
                font-size: 0.9rem;
                word-wrap: break-word;
            }

            th, td {
                padding: 0.5rem;
            }

            h2 {
                font-size: 1.3rem;
                margin-bottom: 1rem;
            }
        }

        @media (max-width: 400px) {
            table, th, td {
                font-size: 0.8rem;
                padding: 0.4rem;
            }
        }

        /* Optional: Scrollable table for narrow screens */
        @media (max-width: 500px) {
            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>

        <h2>Reports for {{ $schoolCode }}</h2>

        <table>
            <thead>
                <tr>
                    <th>Reference</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reports as $report)
                    <tr>
                        <td>{{ $report->reference_number }}</td>
                        <td>{{ $report->category }}</td>
                        <td>{{ $report->description }}</td>
                        <td>{{ $report->status }}</td>
                        <td>{{ $report->created_at->format('Y-m-d') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5">No reports found for this school.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
