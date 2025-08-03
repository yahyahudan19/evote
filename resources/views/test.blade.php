<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemilihan Umum 2025</title>
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        :root {
            --primary: #3b82f6;
            --primary-dark: #2563eb;
            --secondary: #10b981;
            --secondary-dark: #059669;
            --dark: #1e293b;
            --darker: #0f172a;
            --light: #f8fafc;
            --lighter: #ffffff;
            --gray: #64748b;
            --border: #e2e8f0;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            color: var(--dark);
            min-height: 100vh;
            padding: 20px;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header Styles */
        .header {
            text-align: center;
            margin-bottom: 40px;
            background: var(--lighter);
            padding: 40px 30px;
            border-radius: 20px;
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
        }

        .header h1 {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--darker);
            margin-bottom: 12px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            display: inline-block;
        }

        .header p {
            font-size: 1.1rem;
            color: var(--gray);
            font-weight: 400;
            margin-bottom: 24px;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Countdown Styles */
        .countdown-container {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-radius: 16px;
            padding: 28px;
            margin: 30px auto 0;
            border: 1px solid var(--border);
            max-width: 600px;
        }

        .countdown-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--darker);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .countdown-title svg {
            width: 24px;
            height: 24px;
        }

        .countdown-timer {
            display: flex;
            justify-content: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .time-unit {
            background: var(--lighter);
            border-radius: 12px;
            padding: 20px 16px;
            min-width: 90px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: var(--transition);
        }

        .time-unit:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        }

        .time-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary-dark);
            display: block;
            line-height: 1;
            font-feature-settings: "tnum";
            font-variant-numeric: tabular-nums;
        }

        .time-label {
            font-size: 0.875rem;
            color: var(--gray);
            font-weight: 600;
            margin-top: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .voting-period {
            font-size: 0.95rem;
            color: var(--gray);
            margin-top: 24px;
            padding-top: 16px;
            border-top: 1px solid var(--border);
            text-align: center;
            font-weight: 500;
        }

        /* Candidates Grid */
        .candidates-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
            gap: 30px;
            margin-bottom: 50px;
        }

        .candidate-card {
            background: var(--lighter);
            border-radius: 24px;
            padding: 36px;
            box-shadow: var(--shadow);
            transition: var(--transition);
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .candidate-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            opacity: 0;
            transition: var(--transition);
        }

        .candidate-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.12);
        }

        .candidate-card:hover::before {
            opacity: 1;
        }

        /* Candidate Photos */
        .candidate-photos {
            display: flex;
            justify-content: center;
            gap: 24px;
            margin-bottom: 28px;
        }

        .photo-container {
            text-align: center;
            position: relative;
        }

        .photo-container::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60%;
            height: 8px;
            background: rgba(59, 130, 246, 0.2);
            border-radius: 50%;
            filter: blur(4px);
            opacity: 0;
            transition: var(--transition);
        }

        .candidate-card:hover .photo-container::after {
            opacity: 1;
            bottom: -8px;
        }

        .candidate-photo {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid var(--lighter);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            transition: var(--transition);
            position: relative;
            z-index: 1;
        }

        .candidate-photo:hover {
            transform: scale(1.08);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);
        }

        .photo-label {
            font-size: 0.875rem;
            color: var(--gray);
            margin-top: 12px;
            font-weight: 600;
            transition: var(--transition);
        }

        .candidate-card:hover .photo-label {
            color: var(--primary-dark);
        }

        /* Candidate Names */
        .candidate-names {
            text-align: center;
            margin-bottom: 32px;
        }

        .candidate-names h2 {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--darker);
            margin-bottom: 4px;
            line-height: 1.3;
        }

        .candidate-names h3 {
            font-size: 1.25rem;
            font-weight: 500;
            color: var(--gray);
            opacity: 0.9;
        }

        /* Visi Misi */
        .visi-misi {
            margin-bottom: 36px;
            flex-grow: 1;
        }

        .visi-misi h4 {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--darker);
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .visi-misi h4::before {
            content: '';
            width: 6px;
            height: 24px;
            background: linear-gradient(180deg, var(--primary), var(--secondary));
            border-radius: 3px;
        }

        .visi-misi ul {
            list-style: none;
            padding-left: 0;
        }

        .visi-misi li {
            padding: 10px 0;
            color: var(--dark);
            line-height: 1.6;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            position: relative;
            padding-left: 28px;
        }

        .visi-misi li::before {
            content: '';
            position: absolute;
            left: 0;
            top: 16px;
            width: 12px;
            height: 12px;
            background: var(--secondary);
            border-radius: 50%;
            transform: translateY(-50%);
        }

        /* Vote Button */
        .vote-button {
            width: 100%;
            padding: 18px 24px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: var(--lighter);
            border: none;
            border-radius: 14px;
            font-size: 1.125rem;
            font-weight: 700;
            cursor: pointer;
            transition: var(--transition);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: auto;
        }

        .vote-button svg {
            width: 20px;
            height: 20px;
        }

        .vote-button:hover {
            background: linear-gradient(135deg, var(--primary-dark) 0%, #1d4ed8 100%);
            transform: translateY(-3px);
            box-shadow: 0 12px 24px rgba(59, 130, 246, 0.3);
        }

        .vote-button:active {
            transform: translateY(0);
        }

        /* Selected State */
        .selected {
            border-color: var(--secondary);
            background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 100%);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.2); }
            70% { box-shadow: 0 0 0 12px rgba(16, 185, 129, 0); }
            100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }

        .selected .vote-button {
            background: linear-gradient(135deg, var(--secondary) 0%, var(--secondary-dark) 100%);
        }

        .selected .vote-button:hover {
            background: linear-gradient(135deg, var(--secondary-dark) 0%, #047857 100%);
        }

        /* Footer */
        .footer {
            text-align: center;
            margin-top: 60px;
            padding: 30px;
            background: var(--lighter);
            border-radius: 20px;
            box-shadow: var(--shadow);
            position: relative;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 200px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            border-radius: 2px;
        }

        .confirm-button {
            padding: 18px 48px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: var(--lighter);
            border: none;
            border-radius: 14px;
            font-size: 1.125rem;
            font-weight: 700;
            cursor: pointer;
            transition: var(--transition);
            opacity: 0.5;
            pointer-events: none;
            margin-bottom: 24px;
            display: inline-flex;
            align-items: center;
            gap: 12px;
        }

        .confirm-button svg {
            width: 20px;
            height: 20px;
        }

        .confirm-button.active {
            opacity: 1;
            pointer-events: auto;
            animation: pulse 2s infinite;
        }

        .confirm-button:hover.active {
            background: linear-gradient(135deg, var(--primary-dark) 0%, #1d4ed8 100%);
            transform: translateY(-3px);
            box-shadow: 0 12px 24px rgba(59, 130, 246, 0.3);
        }

        .copyright {
            font-size: 0.875rem;
            color: var(--gray);
            font-weight: 400;
            padding-top: 20px;
            border-top: 1px solid var(--border);
        }

        /* Dark Mode Toggle */
        .dark-mode-toggle {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--lighter);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 100;
            border: none;
            color: var(--dark);
            transition: var(--transition);
        }

        .dark-mode-toggle:hover {
            transform: scale(1.1) rotate(30deg);
        }

        .dark-mode-toggle svg {
            width: 24px;
            height: 24px;
        }

        /* Dark Mode Styles */
        body.dark-mode {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: #e2e8f0;
        }

        .dark-mode .header,
        .dark-mode .candidate-card,
        .dark-mode .footer,
        .dark-mode .countdown-container,
        .dark-mode .time-unit {
            background: #1e293b;
            color: #f8fafc;
            border-color: #334155;
        }

        .dark-mode .header h1,
        .dark-mode .candidate-names h2,
        .dark-mode .visi-misi h4,
        .dark-mode .countdown-title {
            color: #f8fafc;
        }

        .dark-mode .header p,
        .dark-mode .photo-label,
        .dark-mode .candidate-names h3,
        .dark-mode .visi-misi li,
        .dark-mode .voting-period,
        .dark-mode .copyright {
            color: #94a3b8;
        }

        .dark-mode .visi-misi li::before {
            background: var(--secondary);
        }

        .dark-mode .selected {
            background: linear-gradient(135deg, #1a2e1f 0%, #0d1f17 100%);
        }

        .dark-mode .time-number {
            color: var(--primary);
        }

        .dark-mode .dark-mode-toggle {
            background: #334155;
            color: #e2e8f0;
        }

        /* Responsive Styles */
        @media (max-width: 1024px) {
            .candidates-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }
            
            .candidate-card {
                padding: 30px;
            }
        }

        @media (max-width: 768px) {
            .header {
                padding: 30px 20px;
            }
            
            .header h1 {
                font-size: 2rem;
            }
            
            .countdown-timer {
                gap: 12px;
            }
            
            .time-unit {
                min-width: 80px;
                padding: 16px 12px;
            }
            
            .time-number {
                font-size: 2rem;
            }
            
            .candidate-photos {
                gap: 20px;
            }
            
            .candidate-photo {
                width: 120px;
                height: 120px;
            }
        }

        @media (max-width: 500px) {
            .header {
                padding: 24px 16px;
            }
            
            .header h1 {
                font-size: 1.75rem;
            }
            
            .countdown-timer {
                gap: 8px;
            }
            
            .time-unit {
                min-width: 70px;
                padding: 12px 8px;
            }
            
            .time-number {
                font-size: 1.75rem;
            }
            
            .time-label {
                font-size: 0.75rem;
            }
            
            .candidate-photos {
                flex-direction: column;
                align-items: center;
                gap: 20px;
            }
            
            .candidate-names h2 {
                font-size: 1.5rem;
            }
            
            .candidate-names h3 {
                font-size: 1.1rem;
            }
            
            .vote-button,
            .confirm-button {
                padding: 16px 24px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header animate__animated animate__fadeInDown">
            <h1>Pemilihan Umum 2025</h1>
            <p>Gunakan hak pilih Anda dengan bijak untuk menentukan masa depan bangsa</p>
            
            <div class="countdown-container animate__animated animate__fadeInUp">
                <div class="countdown-title">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Waktu Tersisa Pemilihan
                </div>
                <div class="countdown-timer" id="countdown">
                    <div class="time-unit">
                        <span class="time-number" id="days">--</span>
                        <div class="time-label">Hari</div>
                    </div>
                    <div class="time-unit">
                        <span class="time-number" id="hours">--</span>
                        <div class="time-label">Jam</div>
                    </div>
                    <div class="time-unit">
                        <span class="time-number" id="minutes">--</span>
                        <div class="time-label">Menit</div>
                    </div>
                    <div class="time-unit">
                        <span class="time-number" id="seconds">--</span>
                        <div class="time-label">Detik</div>
                    </div>
                </div>
                <div class="voting-period">
                    Periode Pemilihan: 29 Juli - 15 Agustus 2025
                </div>
            </div>
        </div>

        <div class="candidates-grid">
            <!-- Kandidat 1 -->
            <div class="candidate-card animate__animated animate__fadeInLeft" data-candidate="1">
                <div class="candidate-photos">
                    <div class="photo-container">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=200&h=200&fit=crop&crop=face" alt="Ketua 1" class="candidate-photo">
                        <div class="photo-label">Ketua</div>
                    </div>
                    <div class="photo-container">
                        <img src="https://images.unsplash.com/photo-1494790108755-2616b612b605?w=200&h=200&fit=crop&crop=face" alt="Wakil 1" class="candidate-photo">
                        <div class="photo-label">Wakil</div>
                    </div>
                </div>

                <div class="candidate-names">
                    <h2>Ahmad Soekarno</h2>
                    <h3>& Siti Rahayu</h3>
                </div>

                <div class="visi-misi">
                    <h4>Visi & Misi</h4>
                    <ul>
                        <li>Mewujudkan pemerintahan yang bersih dan transparan dengan sistem akuntabilitas publik</li>
                        <li>Meningkatkan kesejahteraan rakyat melalui program ekonomi kerakyatan berbasis UMKM</li>
                        <li>Memperkuat sistem pendidikan dan kesehatan yang berkualitas dan terjangkau</li>
                        <li>Membangun infrastruktur yang merata di seluruh wilayah Indonesia</li>
                        <li>Menjaga persatuan dan kesatuan bangsa dengan politik inklusif</li>
                    </ul>
                </div>

                <button class="vote-button" onclick="selectCandidate(1)">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Pilih Pasangan Ini
                </button>
            </div>

            <!-- Kandidat 2 -->
            <div class="candidate-card animate__animated animate__fadeInRight" data-candidate="2">
                <div class="candidate-photos">
                    <div class="photo-container">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=200&h=200&fit=crop&crop=face" alt="Ketua 2" class="candidate-photo">
                        <div class="photo-label">Ketua</div>
                    </div>
                    <div class="photo-container">
                        <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=200&h=200&fit=crop&crop=face" alt="Wakil 2" class="candidate-photo">
                        <div class="photo-label">Wakil</div>
                    </div>
                </div>

                <div class="candidate-names">
                    <h2>Budi Santoso</h2>
                    <h3>& Dewi Kartika</h3>
                </div>

                <div class="visi-misi">
                    <h4>Visi & Misi</h4>
                    <ul>
                        <li>Membangun ekonomi digital yang berkelanjutan dengan dukungan startup lokal</li>
                        <li>Menciptakan 5 juta lapangan kerja melalui inovasi teknologi dan industri 4.0</li>
                        <li>Memperkuat sistem hukum yang berkeadilan dan berpihak pada rakyat kecil</li>
                        <li>Mengembangkan pariwisata dan industri kreatif sebagai tulang punggung ekonomi</li>
                        <li>Melestarikan lingkungan dengan program ekonomi hijau berkelanjutan</li>
                    </ul>
                </div>

                <button class="vote-button" onclick="selectCandidate(2)">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Pilih Pasangan Ini
                </button>
            </div>
        </div>

        <div class="footer animate__animated animate__fadeInUp">
            <button class="confirm-button" id="confirmButton" onclick="confirmVote()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Konfirmasi Pilihan
            </button>
            <div class="copyright">
                2025© Komisi Pemilihan Umum Republik Indonesia
            </div>
        </div>
    </div>

    <button class="dark-mode-toggle" id="darkModeToggle" aria-label="Toggle dark mode">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
        </svg>
    </button>

    <script>
        // DOM Elements
        const darkModeToggle = document.getElementById('darkModeToggle');
        const confirmButton = document.getElementById('confirmButton');
        let selectedCandidate = null;

        // Set voting end date - 15 Agustus 2025, 23:59:59
        const votingEndDate = new Date('August 15, 2025 23:59:59').getTime();

        // Initialize
        document.addEventListener('DOMContentLoaded', () => {
            // Check for dark mode preference
            if (localStorage.getItem('darkMode') === 'true') {
                document.body.classList.add('dark-mode');
            }
            
            // Update countdown immediately
            updateCountdown();
            
            // Set countdown interval
            setInterval(updateCountdown, 1000);
        });

        // Dark mode toggle
        darkModeToggle.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
            const isDarkMode = document.body.classList.contains('dark-mode');
            localStorage.setItem('darkMode', isDarkMode);
            
            // Animate toggle button
            darkModeToggle.classList.add('animate__animated', 'animate__rubberBand');
            setTimeout(() => {
                darkModeToggle.classList.remove('animate__animated', 'animate__rubberBand');
            }, 1000);
        });

        // Update countdown timer
        function updateCountdown() {
            const now = new Date().getTime();
            const timeLeft = votingEndDate - now;

            if (timeLeft > 0) {
                const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

                document.getElementById('days').textContent = String(days).padStart(2, '0');
                document.getElementById('hours').textContent = String(hours).padStart(2, '0');
                document.getElementById('minutes').textContent = String(minutes).padStart(2, '0');
                document.getElementById('seconds').textContent = String(seconds).padStart(2, '0');
            } else {
                // Voting has ended
                document.getElementById('days').textContent = '00';
                document.getElementById('hours').textContent = '00';
                document.getElementById('minutes').textContent = '00';
                document.getElementById('seconds').textContent = '00';
                
                // Disable voting
                document.querySelectorAll('.vote-button').forEach(button => {
                    button.disabled = true;
                    button.style.opacity = '0.5';
                    button.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg> Pemilihan Berakhir';
                });
                
                document.querySelector('.countdown-title').textContent = 'Pemilihan Telah Berakhir';
            }
        }

        // Select candidate
        function selectCandidate(candidateNum) {
            // Remove previous selection
            document.querySelectorAll('.candidate-card').forEach(card => {
                card.classList.remove('selected');
            });

            // Add selection to clicked candidate
            const selectedCard = document.querySelector(`[data-candidate="${candidateNum}"]`);
            selectedCard.classList.add('selected');
            
            // Add animation
            selectedCard.classList.add('animate__animated', 'animate__pulse');
            setTimeout(() => {
                selectedCard.classList.remove('animate__animated', 'animate__pulse');
            }, 1000);
            
            selectedCandidate = candidateNum;
            
            // Enable confirm button
            confirmButton.classList.add('active');
            
            // Scroll to confirm button smoothly
            setTimeout(() => {
                confirmButton.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }, 500);
        }

        // Confirm vote
        async function confirmVote() {
            if (!selectedCandidate) return;

            const candidateName = selectedCandidate === 1 
                ? 'Ahmad Soekarno & Siti Rahayu' 
                : 'Budi Santoso & Dewi Kartika';
            
            // Show confirmation dialog
            const { isConfirmed } = await Swal.fire({
                title: 'Konfirmasi Pilihan Anda',
                html: `
                    <div style="text-align: center; margin: 20px 0;">
                        <div style="font-size: 1.2rem; margin-bottom: 16px;">Anda memilih:</div>
                        <div style="font-size: 1.5rem; font-weight: 700; color: #3b82f6; margin-bottom: 24px;">${candidateName}</div>
                        <div style="font-size: 1rem; color: #64748b;">Pilihan ini tidak dapat diubah setelah dikonfirmasi</div>
                    </div>
                `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Saya Yakin',
                cancelButtonText: 'Kembali',
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#64748b',
                customClass: {
                    popup: 'animate__animated animate__fadeInDown'
                }
            });

            if (isConfirmed) {
                await showVerificationDialog(candidateName);
            }
        }

        // Show verification dialog
        async function showVerificationDialog(candidateName) {
            const { value: formValues } = await Swal.fire({
                title: 'Verifikasi Identitas',
                html: `
                    <div style="text-align: left; margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Nomor KTP</label>
                        <input id="swal-input1" class="swal2-input" placeholder="Masukkan 16 digit NIK" maxlength="16" inputmode="numeric" pattern="[0-9]*">
                    </div>
                    <div style="text-align: left;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Tanggal Lahir (DD/MM/YYYY)</label>
                        <input id="swal-input2" class="swal2-input" placeholder="Contoh: 17/08/1945" maxlength="10">
                    </div>
                `,
                width: '500px',
                focusConfirm: false,
                showCancelButton: true,
                confirmButtonText: 'Verifikasi',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#64748b',
                preConfirm: () => {
                    const ktpNumber = document.getElementById('swal-input1').value.trim();
                    const birthDate = document.getElementById('swal-input2').value.trim();
                    
                    if (!ktpNumber || !birthDate) {
                        Swal.showValidationMessage('Mohon lengkapi semua field');
                        return false;
                    }
                    
                    if (ktpNumber.length !== 16) {
                        Swal.showValidationMessage('Nomor KTP harus 16 digit');
                        return false;
                    }
                    
                    if (!/^\d{2}\/\d{2}\/\d{4}$/.test(birthDate)) {
                        Swal.showValidationMessage('Format tanggal tidak valid (DD/MM/YYYY)');
                        return false;
                    }
                    
                    return [ktpNumber, birthDate];
                }
            });

            if (formValues) {
                await processVerification(candidateName, formValues[0], formValues[1]);
            }
        }

        // Process verification
        async function processVerification(candidateName, ktpNumber, birthDate) {
            // Show loading with progress
            let timerInterval;
            await Swal.fire({
                title: 'Memverifikasi Data Anda',
                html: `
                    <div style="margin: 20px 0; text-align: center;">
                        <div style="font-size: 1rem; margin-bottom: 16px; color: #64748b;">Harap tunggu, kami sedang memverifikasi data Anda...</div>
                        <div style="width: 100%; background: #e2e8f0; border-radius: 10px; height: 10px; overflow: hidden;">
                            <div id="progress-bar" style="height: 100%; background: linear-gradient(90deg, #3b82f6, #10b981); width: 0%; border-radius: 10px; transition: width 0.3s;"></div>
                        </div>
                    </div>
                `,
                timer: 3000,
                timerProgressBar: false,
                allowEscapeKey: false,
                allowOutsideClick: false,
                didOpen: () => {
                    // Simulate progress
                    const progressBar = document.getElementById('progress-bar');
                    let progress = 0;
                    const interval = setInterval(() => {
                        progress += 5;
                        progressBar.style.width = `${progress}%`;
                        if (progress >= 100) clearInterval(interval);
                    }, 150);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                }
            });

            // Show success with confetti
            await Swal.fire({
                title: 'Terima Kasih!',
                html: `
                    <div style="text-align: center; margin: 20px 0;">
                        <div style="font-size: 1.2rem; margin-bottom: 16px;">Pilihan Anda untuk:</div>
                        <div style="font-size: 1.5rem; font-weight: 700; color: #10b981; margin-bottom: 24px;">${candidateName}</div>
                        <div style="font-size: 1rem; color: #64748b;">telah berhasil dicatat dalam sistem pemilihan</div>
                    </div>
                `,
                icon: 'success',
                confirmButtonText: 'Selesai',
                confirmButtonColor: '#3b82f6',
                willOpen: () => {
                    // Trigger confetti effect
                    const duration = 3 * 1000;
                    const animationEnd = Date.now() + duration;
                    const defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 0 };
                    
                    function randomInRange(min, max) {
                        return Math.random() * (max - min) + min;
                    }
                    
                    const interval = setInterval(() => {
                        const timeLeft = animationEnd - Date.now();
                        
                        if (timeLeft <= 0) {
                            return clearInterval(interval);
                        }
                        
                        const particleCount = 50 * (timeLeft / duration);
                        
                        // Since particles fall down, start a bit higher than random
                        window.confetti({
                            ...defaults,
                            particleCount,
                            origin: { x: randomInRange(0.1, 0.3), y: Math.random() - 0.2 }
                        });
                        window.confetti({
                            ...defaults,
                            particleCount,
                            origin: { x: randomInRange(0.7, 0.9), y: Math.random() - 0.2 }
                        });
                    }, 250);
                }
            });

            resetVotingState();
        }

        // Reset voting state
        function resetVotingState() {
            // Reset selection with animation
            document.querySelectorAll('.candidate-card').forEach(card => {
                if (card.classList.contains('selected')) {
                    card.classList.add('animate__animated', 'animate__fadeOut');
                    setTimeout(() => {
                        card.classList.remove('selected', 'animate__animated', 'animate__fadeOut');
                        card.style.opacity = '1';
                    }, 500);
                }
            });
            
            confirmButton.classList.remove('active');
            selectedCandidate = null;
        }

        // Add button press effect
        document.querySelectorAll('button').forEach(button => {
            button.addEventListener('mousedown', () => {
                button.classList.add('animate__animated', 'animate__pulse');
                setTimeout(() => {
                    button.classList.remove('animate__animated', 'animate__pulse');
                }, 500);
            });
        });
    </script>
</body>
</html>