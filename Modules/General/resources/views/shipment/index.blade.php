@extends('general::layouts.master')

@section('content')

<div class="container mt-3">
    <h1 class="mb-4">Simulasi Ongkir</h1>

    <form id="shipping-form">
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="province" class="form-label">Provinsi</label>
                <select id="province" class="form-select" required>
                    <option value="">Pilih Provinsi</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="city" class="form-label">Kota</label>
                <select id="city" class="form-select" required disabled>
                    <option value="">Pilih Kota</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label for="weight" class="form-label">Berat (gram)</label>
            <input type="number" id="weight" class="form-control" placeholder="Masukkan berat" required>
        </div>

        <div class="mb-3">
            <label for="courier" class="form-label">Kurir</label>
            <select id="courier" class="form-select" required>
                <option value="">Pilih Kurir</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Hitung Ongkir</button>
    </form>

    <div id="result" class="mt-4"></div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM loaded');

        // Fetch provinces
        fetch('/shipment/provinces')
            .then(response => response.json())
            .then(data => {
                const provinceSelect = document.getElementById('province');
                data.rajaongkir.results.forEach(province => {
                    const option = document.createElement('option');
                    option.value = province.province_id;
                    option.textContent = province.province;
                    provinceSelect.appendChild(option);
                });
            });

        // Handle province change
        document.getElementById('province').addEventListener('change', function() {
            const provinceId = this.value;
            if (provinceId) {
                fetch(`/shipment/cities?province_id=${provinceId}`)
                    .then(response => response.json())
                    .then(data => {
                        const citySelect = document.getElementById('city');
                        citySelect.innerHTML = '<option value="">Pilih Kota</option>'; // Reset options
                        data.rajaongkir.results.forEach(city => {
                            const option = document.createElement('option');
                            option.value = city.city_id;
                            option.textContent = city.city_name;
                            citySelect.appendChild(option);
                        });
                        citySelect.disabled = false; // Enable city select
                    });
            }
        });

        // Fetch couriers
        fetch('/shipment/couriers')
            .then(response => response.json())
            .then(data => {
                const courierSelect = document.getElementById('courier');
                data.rajaongkir.results.forEach(courier => {
                    const option = document.createElement('option');
                    option.value = courier.courier_id;
                    option.textContent = courier.courier_name;
                    courierSelect.appendChild(option);
                });
            });

        // Handle form submission
        document.getElementById('shipping-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const origin = document.getElementById('city').value;
            const destination = document.getElementById('city').value;
            const weight = document.getElementById('weight').value;
            const courier = document.getElementById('courier').value;

            fetch('/shipment/shipping-cost', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ origin, destination, weight, courier })
            })
            .then(response => response.json())
            .then(data => {
                const resultDiv = document.getElementById('result');
                if (data.error) {
                    resultDiv.innerHTML = `
                        <div class="alert alert-danger">
                            <strong>Terjadi kesalahan:</strong> ${data.error}
                        </div>
                    `;
                } else if (data.rajaongkir && data.rajaongkir.results) {
                    const results = data.rajaongkir.results.map(result => `
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5>${result.name}</h5>
                            </div>
                            <ul class="list-group list-group-flush">
                                ${result.costs.map(cost => `
                                    <li class="list-group-item">
                                        <strong>Service:</strong> ${cost.service}<br>
                                        <strong>Description:</strong> ${cost.description}<br>
                                        <strong>Biaya:</strong> ${cost.cost[0].value} IDR<br>
                                        <strong>Estimasi:</strong> ${cost.cost[0].etd} hari
                                    </li>
                                `).join('')}
                            </ul>
                        </div>
                    `).join('');
                    resultDiv.innerHTML = results;
                } else {
                    resultDiv.innerHTML = '<div class="alert alert-warning">Data ongkir tidak ditemukan.</div>';
                }
            })
            .catch(error => {
                document.getElementById('result').innerHTML = `
                    <div class="alert alert-danger">
                        <strong>Terjadi kesalahan:</strong> ${error.message}
                    </div>
                `;
            });
        });
    });
</script>
@endsection
