<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Report</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        h1 {
            margin-bottom: 30px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            text-align: center;
            padding: 12px;
            border: 1px solid #dee2e6;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        @media print {
            body {
                -webkit-print-color-adjust: exact; /* Preserve background colors */
            }
            .print-button {
                display: none; /* Hide print button during printing */
            }
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Monthly Report</h1>
        
        <form id="filter_form" class="mb-4">
            <div class="form-group">
                <label for="month">Select Month:</label>
                <select name="month" id="month" class="form-control" required>
                    <option value="">--Select Month--</option>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Generate Report</button>
        </form>

        <div id="report" class="mt-5"></div>
    </div>

    <script>
        $(document).ready(function () {
            $('#filter_form').on('submit', function (e) {
                e.preventDefault(); // Prevent the form from submitting the default way
                
                const month = $('#month').val();
                
                $.ajax({
                    type: 'POST',
                    url: 'fetch_report.php', // Change this to your PHP file name
                    data: { month: month },
                    success: function (response) {
                        $('#report').html(response);
                    },
                    error: function () {
                        $('#report').html('<p class="text-danger">Error fetching report. Please try again.</p>');
                    }
                });
            });
        });
    </script>
</body>
</html>
