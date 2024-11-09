document.addEventListener("DOMContentLoaded", function() {
    fetch('/api/provinces')
        .then(response => response.json())
        .then(data => {
            let provinceSelect = document.getElementById('province_origin');
            data.forEach(province => {
                let option = document.createElement('option');
                option.value = province.province_id;
                option.textContent = province.province;
                provinceSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching provinces:', error));

    document.getElementById('province_origin').addEventListener('change', function() {
        let provinceId = this.value;
        fetch(`/api/cities/${provinceId}`)
            .then(response => response.json())
            .then(data => {
                let citySelect = document.getElementById('city_origin');
                citySelect.innerHTML = '<option value="">-</option>'; 
                data.forEach(city => {
                    let option = document.createElement('option');
                    option.value = city.city_id;
                    option.textContent = city.city_name;
                    citySelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching cities:', error));
    });

    document.getElementById('province_origin').addEventListener('change', function() {
        let provinceId = this.value;
        fetch(`/api/cities/${provinceId}`)
            .then(response => response.json())
            .then(data => {
                let citySelect = document.getElementById('city_destination');
                citySelect.innerHTML = '<option value="">-</option>'; 
                data.forEach(city => {
                    let option = document.createElement('option');
                    option.value = city.city_id;
                    option.textContent = city.city_name;
                    citySelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching cities:', error));
    });
});