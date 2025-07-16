<div class="container my-5">
    <h2 class="mb-4 text-center display-6">Checker</h2>
    <!-- Loading state -->
    <div wire:loading.delay class="alert alert-info">
        Loading, please wait...
    </div>

    <!-- Form -->
    <form wire:submit.prevent="submit">
        <div class="row">
            @foreach ($questions as $index => $question)
                @if ($search === '' || stripos($question, $search) !== false)
                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-semibold d-block mb-2">
                            {{ $index + 1 }}. {{ $question }}
                        </label>

                        @if ($index === 0)
                            <!-- Question 1 - Date of Accident -->
                            <select wire:model.defer="formData.{{ $index }}" class="form-select">
                                <option value="">Select an option</option>
                                @foreach ($dateOfAccidentOptions as $option)
                                    <option value="{{ $option }}">{{ $option }}</option>
                                @endforeach
                            </select>

                        @elseif ($index === 1)
                            <!-- Question 2 - Treatment Window -->
                            <select wire:model.defer="formData.{{ $index }}" class="form-select">
                                <option value="">Select an option</option>
                                @foreach ($treatmentWindowOptions as $option)
                                    <option value="{{ $option }}">{{ $option }}</option>
                                @endforeach
                            </select>

                        @else
                            <!-- All other questions -->
                            <div class="btn-group w-100" role="group">
                                @foreach ($yesNoOptions as $option)
                                    <button type="button"
                                            class="btn w-100 {{ ($formData[$index] ?? null) === $option ? 'btn-primary' : 'btn-outline-primary' }}"
                                            wire:click="selectOption({{ $index }}, '{{ $option }}')"
                                            style="transition: background-color 0.2s, color 0.2s;">
                                        {{ $option }}
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Error Message -->
        @if ($errorMessage)
            <div class="alert alert-danger">
                {{ $errorMessage }}
            </div>
        @endif

        <!-- Submit Button -->
        <div class="text-center mt-4">
            <button type="button" wire:click="submit" class="btn btn-success btn-lg">
                Submit
                <span wire:loading wire:target="submit" class="spinner-border spinner-border-sm ms-2" role="status" aria-hidden="true"></span>
            </button>
        </div>
    </form>
    @script
    <script>
        $wire.on('show-qualified-status', () => {
            Swal.fire('Qualified', 'The prospect is qualified!', 'success');
        });
        $wire.on('show-disqualified-status', () => {
            Swal.fire('Not Qualified', 'The prospect is not qualified.', 'error');
        });

    </script>
    @endscript
</div>
<!-- SweetAlert JS (make sure you load SweetAlert2 library first) -->

{{--<script>--}}
{{--    window.addEventListener('show-qualified-status', event => {--}}
{{--        if (event.detail.qualified) {--}}
{{--            Swal.fire('Qualified', 'The applicant is qualified!', 'success');--}}
{{--        } else {--}}
{{--            Swal.fire('Not Qualified', 'The applicant is not qualified.', 'error');--}}
{{--        }--}}
{{--    });--}}
{{--</script>--}}
