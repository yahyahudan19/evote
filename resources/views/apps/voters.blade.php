<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votes | E-Voting v1.5</title>
    <meta charset="utf-8" />
    <meta name="description" content="E-Vote is a modern and secure voting application designed to simplify the voting process with advanced features and user-friendly interfaces." />
    <meta name="keywords" content="e-vote, voting application, secure voting, online voting, election software, digital voting, voting system, e-voting platform" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="id_ID" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="E-Vote - Simplifying the Voting Process" />
    <meta property="og:url" content="https://e-vote.ynemedia.biz.id/" />
    <meta property="og:site_name" content="E-Vote by Edy Corporation" />
    <link rel="shortcut icon" href="{{ asset('templates/assets/media/logos/favicon.ico')}}" />
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    
    <!-- AOS Animation CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    
    <!-- Aptos Font -->
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #4a5568;
            --secondary-color: #2d3748;
            --accent-color: #718096;
            --success-color: #38a169;
            --text-dark: #2d3748;
            --text-light: #718096;
            --bg-light: #f7fafc;
            --bg-gray: #edf2f7;
            --white: #ffffff;
            --border-color: #e2e8f0;
            --selected-bg: #e6fffa;
            --selected-border: #38a169;
            --shadow: 0 4px 12px rgba(0,0,0,0.08);
            --shadow-hover: 0 8px 25px rgba(0,0,0,0.12);
            --border-radius: 12px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Source Sans Pro', 'Aptos', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--bg-light);
            min-height: 100vh;
            color: var(--text-dark);
            line-height: 1.6;
        }

        .main-container {
            background: var(--white);
            margin: 20px auto;
            max-width: 1200px;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            border: 1px solid var(--border-color);
        }

        .header-section {
            background: var(--primary-color);
            padding: 50px 40px;
            text-align: center;
            color: var(--white);
        }

        .header-section h1 {
            font-size: 2.5rem;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .header-section p {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto;
            font-weight: 400;
        }

        .content-section {
            padding: 50px 40px;
        }

        .candidate-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
            margin-bottom: 50px;
        }

        .candidate-card {
            background: var(--white);
            border-radius: var(--border-radius);
            padding: 25px;
            box-shadow: var(--shadow);
            border: 2px solid var(--border-color);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .candidate-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--primary-color);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .candidate-card:hover::before {
            transform: scaleX(1);
        }

        .candidate-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
            border-color: var(--primary-color);
        }

        .candidate-number {
            background: var(--primary-color);
            color: var(--white);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            font-weight: 600;
            margin: 0 auto 20px;
            box-shadow: 0 2px 8px rgba(74, 85, 104, 0.2);
        }

        .candidate-photos {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        .photo-container {
            text-align: center;
        }

        .photo {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--border-color);
            box-shadow: var(--shadow);
            transition: transform 0.3s ease;
        }

        .photo:hover {
            transform: scale(1.03);
        }

        .photo-label {
            margin-top: 8px;
            font-weight: 500;
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .candidate-names {
            text-align: center;
            margin-bottom: 18px;
        }

        .candidate-names h3 {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .candidate-description {
            text-align: center;
            color: var(--text-light);
            line-height: 1.6;
            font-size: 0.95rem;
        }

        .vote-section {
            text-align: center;
            background: var(--bg-gray);
            padding: 40px;
            border-radius: var(--border-radius);
            margin-top: 30px;
        }

        .vote-section h2 {
            font-size: 2.2rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--text-dark);
        }

        .vote-btn {
            background: var(--primary-color);
            border: none;
            padding: 14px 40px;
            border-radius: 8px;
            color: var(--white);
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
        }

        .vote-btn:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
        }

        .vote-btn:disabled {
            background: var(--text-light);
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .modal-content {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-hover);
            border: 1px solid var(--border-color);
        }

        .modal-header {
            background: var(--primary-color);
            color: var(--white);
            border-radius: var(--border-radius) var(--border-radius) 0 0;
            padding: 20px 25px;
            border-bottom: 1px solid var(--border-color);
        }

        .modal-title {
            font-weight: 600;
            font-size: 1.2rem;
        }

        .modal-body {
            padding: 25px;
        }

        .form-control {
            border: 2px solid var(--border-color);
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(74, 85, 104, 0.15);
        }

        .form-label {
            font-weight: 500;
            color: var(--text-dark);
            margin-bottom: 6px;
        }

        .btn-primary {
            background: var(--primary-color);
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: var(--secondary-color);
        }

        .btn-light {
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 500;
            border: 2px solid var(--border-color);
            color: var(--text-dark);
        }

        .btn-light:hover {
            background: var(--bg-gray);
            border-color: var(--text-light);
        }

        .empty-state {
            text-align: center;
            padding: 80px 40px;
            color: var(--text-light);
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
        }

        /* Progress Steps */
        .progress-steps {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 30px;
            position: relative;
        }

        .step {
            display: flex;
            align-items: center;
            position: relative;
        }

        .step-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .step.active .step-circle {
            background: var(--primary-color);
            color: var(--white);
        }

        .step.completed .step-circle {
            background: var(--success-color);
            color: var(--white);
        }

        .step:not(.active):not(.completed) .step-circle {
            background: var(--bg-gray);
            color: var(--text-light);
            border: 2px solid var(--border-color);
        }

        .step-label {
            margin-left: 10px;
            font-weight: 500;
            color: var(--text-dark);
        }

        .step:not(.active):not(.completed) .step-label {
            color: var(--text-light);
        }

        .step-connector {
            width: 60px;
            height: 2px;
            background: var(--border-color);
            margin: 0 20px;
        }

        .step.completed + .step .step-connector,
        .step.completed .step-connector {
            background: var(--success-color);
        }

        /* Candidate Selection Cards */
        .candidate-selection-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .candidate-selection-card {
            border: 2px solid var(--border-color);
            border-radius: var(--border-radius);
            padding: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: var(--white);
            position: relative;
        }

        .candidate-selection-card:hover {
            border-color: var(--primary-color);
            box-shadow: var(--shadow);
        }

        .candidate-selection-card.selected {
            border-color: var(--selected-border);
            background: var(--selected-bg);
            box-shadow: var(--shadow-hover);
        }

        .candidate-selection-card.selected::after {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            top: 15px;
            right: 15px;
            background: var(--success-color);
            color: white;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
        }

        .selection-candidate-number {
            background: var(--primary-color);
            color: var(--white);
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0 auto 15px;
        }

        .selection-candidate-photos {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .selection-photo {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--border-color);
        }

        .selection-candidate-names {
            text-align: center;
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        /* Review Section */
        .review-section {
            background: var(--bg-gray);
            border-radius: var(--border-radius);
            padding: 25px;
            margin-bottom: 25px;
        }

        .review-candidate {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .review-number {
            background: var(--primary-color);
            color: var(--white);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            font-weight: 600;
        }

        .review-photos {
            display: flex;
            gap: 10px;
        }

        .review-photo {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--border-color);
        }

        .review-info h4 {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 5px;
        }

        .review-info p {
            color: var(--text-light);
            margin: 0;
            font-size: 0.9rem;
        }

        /* Loading Animation */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 3px solid var(--border-color);
            border-top: 3px solid var(--primary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .main-container {
                margin: 10px;
            }
            
            .header-section {
                padding: 30px 20px;
            }
            
            .header-section h1 {
                font-size: 2rem;
            }
            
            .content-section {
                padding: 30px 20px;
            }
            
            .candidate-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .candidate-photos {
                flex-direction: column;
                align-items: center;
            }
            
            .vote-section {
                padding: 30px 20px;
            }

            .progress-steps {
                flex-direction: column;
                gap: 15px;
            }

            .step-connector {
                display: none;
            }

            .candidate-selection-grid {
                grid-template-columns: 1fr;
            }

            .review-candidate {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay" style="display: none;">
        <div class="loading-spinner"></div>
    </div>

    <div class="main-container">
        <!-- Header Section -->
        <div class="header-section" data-aos="fade-down">
            <h1><i class="fas fa-vote-yea me-3"></i>Our Candidates</h1>
            <p>Choose your preferred candidate below and make your voice heard in shaping the future!</p>
        </div>

        <!-- Content Section -->
        <div class="content-section">
            <!-- Candidates Grid -->
            <div class="candidate-grid">
                @if ($candidates->isEmpty())
                    <div class="empty-state" data-aos="fade-up">
                        <i class="fas fa-users"></i>
                        <h4>Candidates are not available yet.</h4>
                        <p>Please check back later for candidate information.</p>
                    </div>
                @else
                    @foreach ($candidates as $candidate)
                        <div class="candidate-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <!-- Candidate Number -->
                            <div class="candidate-number">
                                {{ $candidate->candidate_number }}
                            </div>

                            <!-- Photos -->
                            <div class="candidate-photos">
                                <!-- Ketua -->
                                <div class="photo-container">
                                    <img src="{{ asset('storage/' . $candidate->ketua_image_path) }}" 
                                         alt="Ketua" class="photo">
                                    <div class="photo-label">Calon {{$candidate->candidate_number}}</div>
                                </div>

                                {{-- <!-- Wakil -->
                                <div class="photo-container">
                                    <img src="{{ asset('storage/' . $candidate->wakil_image_path) }}" 
                                         alt="Wakil" class="photo">
                                    <div class="photo-label">Wakil</div>
                                </div> --}}
                            </div>

                            <!-- Names -->
                            <div class="candidate-names">
                                {{-- <h3>{{ $candidate->ketua_name }} & {{ $candidate->wakil_name }}</h3> --}}
                                <h3>{{ $candidate->ketua_name }}</h3>
                            </div>

                            <!-- Description -->
                            <div class="candidate-description">
                                {{ $candidate->description }}
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <!-- Vote Section -->
            <div class="vote-section" data-aos="fade-up">
                <h2><i class="fas fa-ballot-check me-3"></i>Vote Now!</h2>
                <p class="mb-4">Make your choice count and contribute to a brighter tomorrow.<br>
                Your vote is your voice, let it be heard!</p>
                
                @if (\Carbon\Carbon::now()->greaterThan(\Carbon\Carbon::parse($election->end_time)))
                    <button class="vote-btn" disabled onclick="showVotingEndedAlert()">
                        <i class="fas fa-clock me-2"></i>Voting Ended
                    </button>
                @elseif ($election->status === 'Y')
                    <button class="vote-btn" data-bs-toggle="modal" data-bs-target="#modal_verify">
                        <i class="fas fa-vote-yea me-2"></i>Vote Now
                    </button>
                @else
                    <button class="vote-btn" disabled onclick="showVotingNotStartedAlert()">
                        <i class="fas fa-hourglass-start me-2"></i>Voting Not Started
                    </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Step 1: Verify Modal -->
    <div class="modal fade" tabindex="-1" id="modal_verify">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title"><i class="fas fa-user-check me-2"></i>Verify Your Identity</h3>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <!-- Progress Steps -->
                    <div class="progress-steps">
                        <div class="step active">
                            <div class="step-circle">1</div>
                            <div class="step-label">Verify</div>
                        </div>
                        <div class="step-connector"></div>
                        <div class="step">
                            <div class="step-circle">2</div>
                            <div class="step-label">Choose</div>
                        </div>
                        <div class="step-connector"></div>
                        <div class="step">
                            <div class="step-circle">3</div>
                            <div class="step-label">Confirm</div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label required">Phone Number</label>
                        <input type="text" class="form-control" placeholder="08123456789" name="phone" id="phone" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label required">Verification Code</label>
                        <input type="text" class="form-control" placeholder="1234" name="code" id="code" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Close
                    </button>
                    <button type="button" class="btn btn-primary" id="kt_button_verify">
                        <span class="indicator-label">
                            <i class="fas fa-check me-2"></i>Verify & Continue
                        </span>
                        <span class="indicator-progress" style="display: none;">
                            <span class="spinner-border spinner-border-sm me-2"></span>Please wait...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Step 2: Select Candidate Modal -->
    <div class="modal fade" tabindex="-1" id="modal_select">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title"><i class="fas fa-vote-yea me-2"></i>Select Your Candidate</h3>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <!-- Progress Steps -->
                    <div class="progress-steps">
                        <div class="step completed">
                            <div class="step-circle"><i class="fas fa-check"></i></div>
                            <div class="step-label">Verify</div>
                        </div>
                        <div class="step-connector"></div>
                        <div class="step active">
                            <div class="step-circle">2</div>
                            <div class="step-label">Choose</div>
                        </div>
                        <div class="step-connector"></div>
                        <div class="step">
                            <div class="step-circle">3</div>
                            <div class="step-label">Confirm</div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5 class="mb-3">Choose Your Preferred Candidate:</h5>
                        <div class="candidate-selection-grid" id="candidateSelectionGrid">
                            @foreach ($candidates as $candidate)
                                <div class="candidate-selection-card" 
                                     data-candidate-id="{{ $candidate->id }}"
                                     data-candidate-number="{{ $candidate->candidate_number }}"
                                     data-ketua-name="{{ $candidate->ketua_name }}"
                                     {{-- data-wakil-name="{{ $candidate->wakil_name }}" --}}
                                     data-ketua-image="{{ asset('storage/' . $candidate->ketua_image_path) }}"
                                     {{-- data-wakil-image="{{ asset('storage/' . $candidate->wakil_image_path) }}" --}}
                                     data-description="{{ $candidate->description }}">
                                    
                                    <div class="selection-candidate-number">
                                        {{ $candidate->candidate_number }}
                                    </div>
                                    
                                    <div class="selection-candidate-photos">
                                        <img src="{{ asset('storage/' . $candidate->ketua_image_path) }}" 
                                             alt="Ketua" class="selection-photo">
                                        {{-- <img src="{{ asset('storage/' . $candidate->wakil_image_path) }}" 
                                             alt="Wakil" class="selection-photo"> --}}
                                    </div>
                                    
                                    <div class="selection-candidate-names">
                                        {{-- {{ $candidate->ketua_name }} & {{ $candidate->wakil_name }} --}}
                                        {{ $candidate->ketua_name }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cancel
                    </button>
                    <button type="button" class="btn btn-primary" id="kt_button_continue" disabled>
                        <i class="fas fa-arrow-right me-2"></i>Continue to Review
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Step 3: Confirm Vote Modal -->
    <div class="modal fade" tabindex="-1" id="modal_confirm">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title"><i class="fas fa-check-circle me-2"></i>Confirm Your Vote</h3>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <!-- Progress Steps -->
                    <div class="progress-steps">
                        <div class="step completed">
                            <div class="step-circle"><i class="fas fa-check"></i></div>
                            <div class="step-label">Verify</div>
                        </div>
                        <div class="step-connector"></div>
                        <div class="step completed">
                            <div class="step-circle"><i class="fas fa-check"></i></div>
                            <div class="step-label">Choose</div>
                        </div>
                        <div class="step-connector"></div>
                        <div class="step active">
                            <div class="step-circle">3</div>
                            <div class="step-label">Confirm</div>
                        </div>
                    </div>

                    <div class="text-center mb-4">
                        <h5>Review Your Choice</h5>
                        <p class="text-muted">Please confirm your selection below. Your choice cannot be changed after voting.</p>
                    </div>

                    <div class="review-section" id="reviewSection">
                        <!-- Selected candidate details will be inserted here -->
                    </div>

                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Important:</strong> Once you submit your vote, it cannot be changed or undone.
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" id="kt_button_back">
                        <i class="fas fa-arrow-left me-2"></i>Back to Selection
                    </button>
                    <button type="button" class="btn btn-primary" id="kt_button_vote">
                        <span class="indicator-label">
                            <i class="fas fa-vote-yea me-2"></i>Submit Vote
                        </span>
                        <span class="indicator-progress" style="display: none;">
                            <span class="spinner-border spinner-border-sm me-2"></span>Submitting...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- AOS Animation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

    <script>
        // Global variables
        let selectedCandidate = null;

        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });

        // Loading overlay functions
        function showLoading() {
            document.getElementById('loadingOverlay').style.display = 'flex';
        }

        function hideLoading() {
            document.getElementById('loadingOverlay').style.display = 'none';
        }

        // Alert functions
        function showVotingEndedAlert() {
            Swal.fire({
                icon: 'info',
                title: 'Voting Ended',
                text: 'The voting process has already ended. Thank you for your participation.',
                confirmButtonColor: '#4a5568'
            });
        }

        function showVotingNotStartedAlert() {
            Swal.fire({
                icon: 'info',
                title: 'Voting Not Started',
                text: 'The voting process has not started yet. Please wait for further announcements.',
                confirmButtonColor: '#4a5568'
            });
        }

        // Candidate selection functionality
        function initializeCandidateSelection() {
            const candidateCards = document.querySelectorAll('.candidate-selection-card');
            const continueButton = document.getElementById('kt_button_continue');

            // Pastikan event listener tidak menumpuk
            candidateCards.forEach(card => {
                card.onclick = function () {
                    // Hapus kelas 'selected' dari semua kartu
                    candidateCards.forEach(c => c.classList.remove('selected'));

                    // Tambah kelas 'selected' pada kartu yang diklik
                    this.classList.add('selected');

                    // Simpan data kandidat terpilih
                    const data = {
                        id: this.dataset.candidateId,
                        number: this.dataset.candidateNumber,
                        ketuaName: this.dataset.ketuaName,
                        // wakilName: this.dataset.wakilName,
                        ketuaImage: this.dataset.ketuaImage,
                        // wakilImage: this.dataset.wakilImage,
                        description: this.dataset.description
                    };
                    selectedCandidate = data;
                    document.body.dataset.selectedCandidate = JSON.stringify(data);

                    console.log("Selected candidate:", selectedCandidate);

                    // Aktifkan tombol continue
                    continueButton.disabled = false;
                };
            });
        }

        // Pastikan initializeCandidateSelection selalu dijalankan setiap kali modal select dibuka
        $('#modal_select').on('shown.bs.modal', function () {
            initializeCandidateSelection();
        });


        // Update review section
        function updateReviewSection() {
            if (!selectedCandidate) return;

            const reviewSection = document.getElementById('reviewSection');
            reviewSection.innerHTML = `
                <div class="review-candidate">
                    <div class="review-number">${selectedCandidate.number}</div>
                    <div class="review-photos">
                        <img src="${selectedCandidate.ketuaImage}" alt="Ketua" class="review-photo">
                    </div>
                    <div class="review-info">
                        <h4>${selectedCandidate.ketuaName}</h4>
                        <p><strong>Calon No. ${selectedCandidate.number}</strong></p>
                        <p>${selectedCandidate.description}</p>
                    </div>
                </div>
            `;
        }

        // Step 1: Verify button functionality
        var verifyButton = document.querySelector("#kt_button_verify");

        verifyButton.addEventListener("click", function() {
            var phone = document.querySelector("[name='phone']").value;
            var code = document.querySelector("[name='code']").value;

            // Validate empty input
            if (!phone || !code) {
                Swal.fire({
                    icon: 'error',
                    title: 'Incomplete Data!',
                    text: 'Please make sure all fields are filled.',
                    confirmButtonColor: '#4a5568'
                });
                return;
            }

            // Show loading state
            verifyButton.querySelector('.indicator-label').style.display = 'none';
            verifyButton.querySelector('.indicator-progress').style.display = 'inline-flex';
            verifyButton.disabled = true;

            // Send AJAX request to verify voter
            fetch("/verify-voter", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    phone: phone,
                    code: code
                })
            })
            .then(response => response.json())
            .then(data => {
                // Reset button state
                verifyButton.querySelector('.indicator-label').style.display = 'inline-flex';
                verifyButton.querySelector('.indicator-progress').style.display = 'none';
                verifyButton.disabled = false;

                if (data.status === "found") {
                    // Close verify modal and open select modal
                    $('#modal_verify').modal('hide');
                    setTimeout(() => {
                        $('#modal_select').modal('show');
                        initializeCandidateSelection();
                    }, 300);
                } else if (data.status === "not_enough_data") {
                    Swal.fire({
                        icon: 'error',
                        title: 'At Least Two Data Points Must Match',
                        text: data.message,
                        confirmButtonColor: '#4a5568'
                    });
                } else if (data.status === "already_voted") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Already Voted!',
                        text: 'You have already voted on ' + data.voted_at,
                        confirmButtonColor: '#4a5568'
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Data Not Found!',
                        text: 'Please ensure the data you entered is correct.',
                        confirmButtonColor: '#4a5568'
                    });
                }
            })
            .catch(error => {
                // Reset button state
                verifyButton.querySelector('.indicator-label').style.display = 'inline-flex';
                verifyButton.querySelector('.indicator-progress').style.display = 'none';
                verifyButton.disabled = false;
                
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Connection Error!',
                    text: 'Please check your internet connection and try again.',
                    confirmButtonColor: '#4a5568'
                });
            });
        });

        // Step 2: Continue to review button
        document.getElementById('kt_button_continue').addEventListener('click', function() {
            if (!selectedCandidate) {
                Swal.fire({
                    icon: 'error',
                    title: 'No Candidate Selected!',
                    text: 'Please select a candidate to continue.',
                    confirmButtonColor: '#4a5568'
                });
                return;
            }

            // Update review section
            updateReviewSection();

            // Tutup modal select, lalu buka modal confirm setelah tertutup
            $('#modal_select').one('hidden.bs.modal', function () {
                $('#modal_confirm').modal('show');
            }).modal('hide');
        });


        // Step 3: Final vote button
        var voteButton = document.querySelector("#kt_button_vote");

        voteButton.addEventListener("click", function() {
            let dataCandidate = selectedCandidate;
            if (!dataCandidate && document.body.dataset.selectedCandidate) {
                dataCandidate = JSON.parse(document.body.dataset.selectedCandidate);
            }

            if (!dataCandidate) {
                Swal.fire({
                    icon: 'error',
                    title: 'No Candidate Selected!',
                    text: 'Please select a candidate to vote.',
                    confirmButtonColor: '#4a5568'
                });
                return;
            }

            Swal.fire({
                title: 'Confirm Your Vote',
                html: `
                    <div style="text-align: center; margin: 20px 0;">
                        <div style="background: #4a5568; color: white; width: 40px; height: 40px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; margin-bottom: 15px;">
                            ${dataCandidate.number}
                        </div>
                        <h4 style="margin: 10px 0; color: #2d3748;">${dataCandidate.ketuaName} & ${dataCandidate.wakilName}</h4>
                        <p style="color: #718096; margin: 0;">Your choice cannot be changed after submission!</p>
                    </div>
                `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, Submit My Vote!',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#4a5568',
                cancelButtonColor: '#718096',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading state
                    voteButton.querySelector('.indicator-label').style.display = 'none';
                    voteButton.querySelector('.indicator-progress').style.display = 'inline-flex';
                    voteButton.disabled = true;

                    // Send voting data to the server
                    fetch("/submit-vote", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            candidate_id: dataCandidate.id
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === "success") {
                            Swal.fire({
                                icon: 'success',
                                title: 'Vote Submitted Successfully!',
                                html: `
                                    <div style="text-align: center; margin: 20px 0;">
                                        <div style="background: #38a169; color: white; width: 60px; height: 60px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 15px;">
                                            <i class="fas fa-check"></i>
                                        </div>
                                        <p style="color: #718096; margin: 10px 0;">Thank you for participating in this election!</p>
                                        <p style="color: #718096; margin: 0;">Your vote for <strong>Calon No. ${dataCandidate.number}</strong> has been recorded.</p>
                                    </div>
                                `,
                                confirmButtonColor: '#4a5568',
                                allowOutsideClick: false,
                                allowEscapeKey: false
                            }).then(() => {
                                window.location.href = "/";
                            });
                        } else {
                            // Reset button state
                            voteButton.querySelector('.indicator-label').style.display = 'inline-flex';
                            voteButton.querySelector('.indicator-progress').style.display = 'none';
                            voteButton.disabled = false;

                            Swal.fire({
                                icon: 'error',
                                title: 'Voting Failed!',
                                text: data.message || 'An error occurred, please try again.',
                                confirmButtonColor: '#4a5568'
                            });
                        }
                    })
                    .catch(error => {
                        // Reset button state
                        voteButton.querySelector('.indicator-label').style.display = 'inline-flex';
                        voteButton.querySelector('.indicator-progress').style.display = 'none';
                        voteButton.disabled = false;

                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Connection Error!',
                            text: 'Please check your internet connection and try again.',
                            confirmButtonColor: '#4a5568'
                        });
                    });
                }
            });
        });

        // Step 4: Back to selection button
        document.getElementById('kt_button_back').addEventListener('click', function () {
            // Tutup modal konfirmasi
            $('#modal_confirm').modal('hide');

            // Setelah modal confirm ditutup, buka kembali modal select
            $('#modal_confirm').one('hidden.bs.modal', function () {
                $('#modal_select').modal('show');
                initializeCandidateSelection(); // Pastikan pilihan kandidat masih aktif
            });
        });

        // Clear forms and reset states when modals are hidden
        $('#modal_verify').on('hidden.bs.modal', function () {
            document.querySelector("[name='phone']").value = '';
            document.querySelector("[name='code']").value = '';
            
            // Reset verify button state
            verifyButton.querySelector('.indicator-label').style.display = 'inline-flex';
            verifyButton.querySelector('.indicator-progress').style.display = 'none';
            verifyButton.disabled = false;
        });

        $('#modal_select').on('hidden.bs.modal', function () {
            const confirmModal = document.getElementById('modal_confirm');
            // Jika modal confirm sedang dibuka, jangan reset
            if (confirmModal.classList.contains('show')) {
                return;
            }

            // Kalau benar-benar keluar dari proses pemilihan, baru reset
            document.querySelectorAll('.candidate-selection-card').forEach(card => {
                card.classList.remove('selected');
            });
            document.getElementById('kt_button_continue').disabled = true;
            selectedCandidate = null;
        });

        $('#modal_confirm').on('hidden.bs.modal', function () {
            // Reset vote button state
            voteButton.querySelector('.indicator-label').style.display = 'inline-flex';
            voteButton.querySelector('.indicator-progress').style.display = 'none';
            voteButton.disabled = false;
        });

        // Prevent modal backdrop clicks from closing modals during voting process
        $('#modal_select, #modal_confirm').on('click', function(e) {
            if (e.target === this) {
                e.preventDefault();
                e.stopPropagation();
            }
        });

        // Keyboard navigation for candidate selection
        document.addEventListener('keydown', function(e) {
            if ($('#modal_select').hasClass('show')) {
                const cards = document.querySelectorAll('.candidate-selection-card');
                const currentSelected = document.querySelector('.candidate-selection-card.selected');
                let currentIndex = currentSelected ? Array.from(cards).indexOf(currentSelected) : -1;

                if (e.key === 'ArrowDown' || e.key === 'ArrowRight') {
                    e.preventDefault();
                    currentIndex = (currentIndex + 1) % cards.length;
                    cards[currentIndex].click();
                    cards[currentIndex].scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                } else if (e.key === 'ArrowUp' || e.key === 'ArrowLeft') {
                    e.preventDefault();
                    currentIndex = currentIndex <= 0 ? cards.length - 1 : currentIndex - 1;
                    cards[currentIndex].click();
                    cards[currentIndex].scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                } else if (e.key === 'Enter' && currentSelected) {
                    e.preventDefault();
                    document.getElementById('kt_button_continue').click();
                }
            }
        });

        // Auto-focus on first input when modals open
        $('#modal_verify').on('shown.bs.modal', function () {
            document.querySelector("[name='phone']").focus();
        });

        // Smooth modal transitions
        $('.modal').on('show.bs.modal', function() {
            $(this).find('.modal-dialog').removeClass('modal-animate-out').addClass('modal-animate-in');
        });

        $('.modal').on('hide.bs.modal', function() {
            $(this).find('.modal-dialog').removeClass('modal-animate-in').addClass('modal-animate-out');
        });

        // Add custom modal animation styles
        const style = document.createElement('style');
        style.textContent = `
            .modal-animate-in {
                animation: modalSlideIn 0.3s ease-out;
            }
            .modal-animate-out {
                animation: modalSlideOut 0.3s ease-in;
            }
            @keyframes modalSlideIn {
                from { transform: scale(0.7) translateY(-50px); opacity: 0; }
                to { transform: scale(1) translateY(0); opacity: 1; }
            }
            @keyframes modalSlideOut {
                from { transform: scale(1) translateY(0); opacity: 1; }
                to { transform: scale(0.7) translateY(-50px); opacity: 0; }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>