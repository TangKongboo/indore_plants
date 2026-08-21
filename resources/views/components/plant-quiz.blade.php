<section class="py-5" style="background: linear-gradient(135deg, rgba(7, 56, 27, 0.9), rgba(5, 46, 22, 1));">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <span class="badge-tag mb-3"><i class="fa-solid fa-wand-magic-sparkles"></i> Try the Quiz</span>
                <h2 class="font-lobster-title fs-1 mb-3">Find Your Perfect Plant</h2>
                <p class="text-soft mb-5">Answer 3 quick questions and we'll match you with a plant that thrives in your unique space.</p>
                
                <div class="plant-card p-4 p-md-5 rounded-4 shadow-lg border mx-auto" style="max-width: 600px; text-align: left;" id="quiz-container">
                    
                    <!-- Progress Bar -->
                    <div class="progress mb-4" style="height: 6px; background-color: rgba(255,255,255,0.1);">
                        <div class="progress-bar bg-warning" id="quiz-progress" role="progressbar" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                    <!-- Step 1: Room -->
                    <div class="quiz-step" id="quiz-step-1">
                        <h4 class="text-white fw-bold mb-4">1. Where will your new plant live?</h4>
                        <div class="d-grid gap-3">
                            <button class="btn btn-outline-light text-start p-3 rounded-3 quiz-choice" data-target="step-2" data-value="room-bedroom">
                                <i class="fa-solid fa-bed text-gold me-2 fs-5"></i> Bedroom (Air purifying)
                            </button>
                            <button class="btn btn-outline-light text-start p-3 rounded-3 quiz-choice" data-target="step-2" data-value="room-living">
                                <i class="fa-solid fa-couch text-gold me-2 fs-5"></i> Living Room (Statement piece)
                            </button>
                            <button class="btn btn-outline-light text-start p-3 rounded-3 quiz-choice" data-target="step-2" data-value="room-office">
                                <i class="fa-solid fa-laptop text-gold me-2 fs-5"></i> Office Desk (Low maintenance)
                            </button>
                        </div>
                    </div>

                    <!-- Step 2: Light -->
                    <div class="quiz-step d-none" id="quiz-step-2">
                        <h4 class="text-white fw-bold mb-4">2. How much natural light does the room get?</h4>
                        <div class="d-grid gap-3">
                            <button class="btn btn-outline-light text-start p-3 rounded-3 quiz-choice" data-target="step-3" data-value="Low Light">
                                <i class="fa-solid fa-cloud text-info me-2 fs-5"></i> Low Light (Small window / mostly shade)
                            </button>
                            <button class="btn btn-outline-light text-start p-3 rounded-3 quiz-choice" data-target="step-3" data-value="Indirect">
                                <i class="fa-solid fa-cloud-sun text-warning me-2 fs-5"></i> Bright Indirect (Well lit, no direct sun rays)
                            </button>
                            <button class="btn btn-outline-light text-start p-3 rounded-3 quiz-choice" data-target="step-3" data-value="Direct">
                                <i class="fa-solid fa-sun text-warning me-2 fs-5"></i> Direct Sun (Sunny window ledge)
                            </button>
                        </div>
                    </div>

                    <!-- Step 3: Pets -->
                    <div class="quiz-step d-none" id="quiz-step-3">
                        <h4 class="text-white fw-bold mb-4">3. Do you have curious cats or dogs?</h4>
                        <div class="d-grid gap-3">
                            <button class="btn btn-outline-light text-start p-3 rounded-3 quiz-choice" data-target="finish" data-value="1">
                                <i class="fa-solid fa-paw text-success me-2 fs-5"></i> Yes, show me 100% Pet Safe plants
                            </button>
                            <button class="btn btn-outline-light text-start p-3 rounded-3 quiz-choice" data-target="finish" data-value="0">
                                <i class="fa-solid fa-xmark text-secondary me-2 fs-5"></i> No pets, show me everything
                            </button>
                        </div>
                    </div>

                    <!-- Analyzing / Results -->
                    <div class="quiz-step d-none text-center py-4" id="quiz-step-finish">
                        <div class="spinner-border text-warning mb-3" role="status" style="width: 3rem; height: 3rem;">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <h4 class="text-white fw-bold">Analyzing your space...</h4>
                        <p class="text-muted small">Finding the perfect botanical matches.</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const choices = document.querySelectorAll('.quiz-choice');
        let quizData = { light: '', pet_friendly: '' };

        choices.forEach(btn => {
            btn.addEventListener('click', function() {
                const target = this.getAttribute('data-target');
                const val = this.getAttribute('data-value');

                // Store answer
                if(this.closest('#quiz-step-2')) quizData.light = val;
                if(this.closest('#quiz-step-3')) quizData.pet_friendly = val;

                // Hide all steps
                document.querySelectorAll('.quiz-step').forEach(step => step.classList.add('d-none'));

                if(target === 'step-2') {
                    document.getElementById('quiz-step-2').classList.remove('d-none');
                    document.getElementById('quiz-progress').style.width = '66%';
                } else if(target === 'step-3') {
                    document.getElementById('quiz-step-3').classList.remove('d-none');
                    document.getElementById('quiz-progress').style.width = '100%';
                } else if(target === 'finish') {
                    document.getElementById('quiz-step-finish').classList.remove('d-none');
                    
                    // Build URL and redirect
                    setTimeout(() => {
                        let queryParams = [];
                        if(quizData.light) queryParams.push(`light=${encodeURIComponent(quizData.light)}`);
                        if(quizData.pet_friendly === '1') queryParams.push(`pet_friendly=1`);
                        
                        let qs = queryParams.length ? '?' + queryParams.join('&') : '';
                        window.location.href = '/shop' + qs;
                    }, 1200); // 1.2s delay for visual effect
                }
            });
        });
    });
</script>
@endpush
