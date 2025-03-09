<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Asistencia</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 900px;
        }
        h2 {
            text-align: left;
            color: #333;
            margin-bottom: 15px;
            font-size: 22px;
            font-weight: bold;
        }
        .attendance-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .attendance-card {
            background: #f2f2f2;
            padding: 15px;
            border-radius: 8px;
        }
        .status {
            display: flex;
            gap: 10px;
        }
        .status button {
            padding: 10px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            flex: 1;
            display: flex;
            align-items: center;
            gap: 5px;
            justify-content: center;
        }
        .present-btn { background: green; color: white; }
        .absent-btn { background: red; color: white; }
        .excused-btn { background: #e4b100; color: white; }
        .details-btn {
            background: #ffffff;
            color: black;
            border: 1px solid #ccc;
            padding: 10px;
            cursor: pointer;
            border-radius: 8px;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* Modal (Ventana Emergente) */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s;
        }
        .modal.active {
            opacity: 1;
            pointer-events: auto;
        }
        .modal-content {
            background: white;
            width: 600px;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 15px;
        }
        .close-btn {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
        }
        .tabs {
            display: flex;
            border-bottom: 2px solid #ccc;
            margin-bottom: 10px;
        }
        .tab {
            flex: 1;
            padding: 10px;
            text-align: center;
            cursor: pointer;
            font-weight: bold;
        }
        .tab.active {
            border-bottom: 3px solid black;
        }
        .student-list {
            display: none;
        }
        .student-list.active {
            display: block;
        }
        .student-item {
            display: flex;
            justify-content: space-between;
            background: #e9f8ea;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
        }
        .student-item .status-btn {
            background: green;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Historial de Asistencia</h2>
        <div class="attendance-list">
            <div class="attendance-card">
                <button class="date-btn">📅 Miércoles, 22 de enero de 2025 - 6to de Informática</button>
                <div class="status">
                    <button class="present-btn">✅ Presentes (24)</button>
                    <button class="absent-btn">❌ Ausentes (1)</button>
                    <button class="excused-btn">📜 Con excusa (1)</button>
                    <button class="details-btn" onclick="openModal()">Ver más ➜</button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL -->
    <div class="modal" id="attendanceModal">
        <div class="modal-content">
            <div class="modal-header">
                📅 Miércoles, 22 de enero de 2025 - 6to de Informática
                <button class="close-btn" onclick="closeModal()">✖</button>
            </div>
            <div class="tabs">
                <div class="tab active" onclick="showTab('presentes')">👤 Presentes (24)</div>
                <div class="tab" onclick="showTab('ausentes')">🚫 Ausentes (1)</div>
                <div class="tab" onclick="showTab('excusas')">📜 Con excusa (1)</div>
            </div>
            <div class="student-list active" id="presentes">
                <div class="student-item">
                    <div>
                        <strong>Neftaly Adon #1</strong><br>Varón
                    </div>
                    <button class="status-btn">✅ Presente</button>
                </div>
                <div class="student-item">
                    <div>
                        <strong>Liz Constanzo #4</strong><br>Hembra
                    </div>
                    <button class="status-btn">✅ Presente</button>
                </div>
                <div class="student-item">
                    <div>
                        <strong>Carlos José #6</strong><br>Varón
                    </div>
                    <button class="status-btn">✅ Presente</button>
                </div>
            </div>
            <div class="student-list" id="ausentes">
                <p>No hay ausentes.</p>
            </div>
            <div class="student-list" id="excusas">
                <p>No hay excusas registradas.</p>
            </div>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById("attendanceModal").classList.add("active");
        }
        function closeModal() {
            document.getElementById("attendanceModal").classList.remove("active");
        }
        function showTab(tabId) {
            document.querySelectorAll(".tab").forEach(tab => tab.classList.remove("active"));
            document.querySelectorAll(".student-list").forEach(list => list.classList.remove("active"));
            document.querySelector(`[onclick="showTab('${tabId}')"]`).classList.add("active");
            document.getElementById(tabId).classList.add("active");
        }
    </script>
</body>
</html>
