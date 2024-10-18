<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Date Input Styling</title>
    <style>
        /* Default styles for the input /
        input[type="date"] {
            font-size: 16px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        / Style for out of range dates */
        /* .out-of-range {
            color: grey;
        } */
    </style>
</head>
<body>
    <form>
        <label>
            Choose your preferred party date:
            <input type="date" name="party" id="party-date" min="2017-04-01" max="2017-04-03" />
        </label>
    </form>

    <script>
        const dateInput = document.getElementById('party-date');

        dateInput.addEventListener('input', function () {
            const value = dateInput.value;
            const minDate = dateInput.min;
            const maxDate = dateInput.max;

            // Check if the selected date is out of range
            if (value < minDate || value > maxDate) {
                dateInput.classList.add('out-of-range');
            } else {
                dateInput.classList.remove('out-of-range');
            }
        });
    </script>
</body>
</html>
