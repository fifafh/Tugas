<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Icon Selection Form</title>
    <!-- Link to Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

    <div class="content">
        <div class="services-description">
            <h3>What I Provide</h3>
        </div>

        <form action="process_form.php" method="post">
            <ul class="service-list">
                <li class="service-container">
                    <div class="service-card">
                        <label for="icon_select">Select Icon:</label>
                        <select id="icon_select" name="selected_icon">
                            <!-- Options will be dynamically populated here -->
                        </select>

                        <h3>Service Name</h3>
                        <div class="learn-more-btn"><i id="selected_icon" class="fas"></i>
                            Learn More</div>
                    </div>
                </li>

                <!-- Add more service items as needed -->
            </ul>

            <!-- Submit Button -->
            <div class="learn-more-btn">
                <button type="submit" name="submit">Submit</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Fetch Font Awesome icons data from official API
            fetch('https://api.fontawesome.com/service/font-awesome/v4/icons')
                .then(response => response.json())
                .then(data => {
                    // Populate the dropdown with dynamically generated options
                    const iconSelect = document.getElementById('icon_select');
                    const selectedIcon = document.getElementById('selected_icon');
                    data.icons.forEach(icon => {
                        const option = document.createElement('option');
                        option.value = icon.id;
                        option.text = icon.id;
                        iconSelect.add(option);
                    });

                    // Update the selected icon when the dropdown changes
                    iconSelect.addEventListener('change', function () {
                        const selectedValue = iconSelect.value;
                        selectedIcon.className = `fas fa-${selectedValue}`;
                    });
                })
                .catch(error => console.error('Error fetching icons:', error));
        });
    </script>
    <!-- Add your other scripts here -->
</body>

</html>
