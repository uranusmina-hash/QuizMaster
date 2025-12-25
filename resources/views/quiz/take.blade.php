@extends('layouts.app') 

@section('title', 'Take Quiz')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10 col-lg-9">
        @if($questions->total() == 0)
            <div class="card shadow-lg border-0">
                <div class="card-body text-center p-5">
                    <i class="bi bi-inbox display-1 text-muted"></i>
                    <h3 class="mt-4 text-muted">No Questions Available</h3>
                    <p class="text-muted">There are no quiz questions at the moment. Please check back later.</p>
                    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg mt-3">
                        <i class="bi bi-arrow-left"></i> Back to Dashboard
                    </a>
                </div>
            </div>
        @else

            <div class="card shadow-lg border-info mb-4">
                <div class="card-body bg-info bg-opacity-10 p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <i class="bi bi-list-check text-info"></i>
                            <strong>Progress:</strong> 
                            <span id="answered-count">{{ count($answers) }}</span> / {{ $totalQuestions }} questions answered
                        </div>
                        <div>
                            <span class="badge bg-info" id="progress-badge">
                                {{ count($answers) == $totalQuestions ? 'Complete' : 'In Progress' }}
                            </span>
                        </div>
                    </div>
                    <div class="progress mt-2" style="height: 8px;">
                        <div class="progress-bar bg-info" role="progressbar" 
                             style="width: {{ $totalQuestions > 0 ? (count($answers) / $totalQuestions * 100) : 0 }}%"
                             id="progress-bar"></div>
                    </div>
                </div>
            </div>

            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="bi bi-pencil-square"></i> Take Quiz
                        </h4>
                        <span class="badge bg-light text-primary fs-6">
                            Page {{ $questions->currentPage() }} of {{ $questions->lastPage() }}
                        </span>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('quiz.save') }}" id="quizForm">
                        @csrf
                        <input type="hidden" name="page" value="{{ $questions->currentPage() }}">

                        @foreach($questions as $i => $q)
                            <div class="card mb-4 border-primary">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">
                                        <span class="badge bg-primary me-2">
                                            Q{{ ($questions->currentPage() - 1) * $questions->perPage() + $i + 1 }}
                                        </span>
                                        {{ $q->question }}

                                        @if(isset($answers[$q->id]))
                                            <span class="badge bg-success ms-2">
                                                <i class="bi bi-check-circle"></i> Answered
                                            </span>
                                        @else
                                            <span class="badge bg-warning ms-2">
                                                <i class="bi bi-exclamation-circle"></i> Not Answered
                                            </span>
                                        @endif
                                    </h5>
                                </div>

                                <div class="card-body">
                                    <div class="list-group">
                                        @for($opt = 1; $opt <= 4; $opt++)
                                            <label class="list-group-item list-group-item-action">
                                                <div class="form-check">
                                                    <input class="form-check-input question-radio"
                                                           type="radio"
                                                           name="answers[{{ $q->id }}]"
                                                           value="{{ $opt }}"
                                                           data-question-id="{{ $q->id }}"
                                                           {{ isset($answers[$q->id]) && $answers[$q->id] == $opt ? 'checked' : '' }}>
                                                    <label class="form-check-label fw-semibold w-100">
                                                        <span class="badge bg-secondary me-2">
                                                            {{ chr(64 + $opt) }}
                                                        </span>
                                                        {{ $q->{'option'.$opt} }}
                                                    </label>
                                                </div>
                                            </label>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Page Navigation -->
                        <div class="card bg-light mb-3">
                            <div class="card-body">
                                <h6 class="mb-3">Quiz Navigation</h6>
                                <div class="d-flex flex-wrap gap-2 justify-content-center">
                                    @for($i = 1; $i <= $questions->lastPage(); $i++)
                                        <button type="submit" name="page" value="{{ $i }}" 
                                                class="btn {{ $i == $questions->currentPage() ? 'btn-primary' : 'btn-outline-primary' }}">
                                            {{ $i }}
                                        </button>
                                    @endfor
                                </div>
                            </div>
                        </div>

                        @if($questions->currentPage() == $questions->lastPage())
                            <div class="text-center">
                                <button type="button"
                                        class="btn btn-success btn-lg px-5"
                                        onclick="submitQuiz()">
                                    <i class="bi bi-check-circle"></i> Submit Quiz
                                </button>

                                <div id="submit-warning" class="text-danger mt-3" style="display:none;">
                                    <i class="bi bi-exclamation-triangle-fill"></i>
                                    <strong>Please answer all questions before submitting!</strong>
                                </div>
                            </div>
                        @endif
                    </form>

                    <div class="text-center mt-4">
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i> Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<script>
    const totalQuestions = {{ $totalQuestions }};
    let answeredQuestions = new Set({!! json_encode(array_keys($answers)) !!});

    document.querySelectorAll('.question-radio').forEach(radio => {
        radio.addEventListener('change', function () {
            answeredQuestions.add(parseInt(this.dataset.questionId));
            updateProgress();
        });
    });

    function updateProgress() {
        const answered = answeredQuestions.size;
        document.getElementById('answered-count').textContent = answered;
        document.getElementById('progress-bar').style.width =
            (answered / totalQuestions) * 100 + '%';

        const badge = document.getElementById('progress-badge');
        if (answered === totalQuestions) {
            badge.textContent = 'Complete';
            badge.className = 'badge bg-success';
        } else {
            badge.textContent = 'In Progress';
            badge.className = 'badge bg-info';
        }
    }

    function submitQuiz() {
        const answered = answeredQuestions.size;

        if (answered < totalQuestions) {
            document.getElementById('submit-warning').style.display = 'block';
            alert(`Please answer all questions.\nAnswered ${answered} of ${totalQuestions}.`);
            return;
        }

        if (confirm('Submit quiz now?')) {
            document.getElementById('quizForm').action = '{{ route('quiz.submit') }}';
            document.getElementById('quizForm').submit();
        }
    }
</script>
@endsection
