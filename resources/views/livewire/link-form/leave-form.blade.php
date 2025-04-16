<div>
    <div class="row mb-3">
        <div class="col-sm-6">
            <h5>Leave Form</h5>
        </div>
        <div class="col-sm-6 text-sm-end">
            <button type="button" class="btn btn-dark" onclick="location.href = '/link-form/leave-approval';"><i class="fa-solid fa-thumbs-up me-2" ></i>Leave Approval</button>
        </div>
    </div>

    <div style="background-color: #696969; color: white; border-radius: 2%;" class="px-2 py-2 px-md-4">
        <form wire:submit.prevent="submit">
            <div class="mt-3 row">
                <div class="col-md-6">
                    <label class="form-label">Start Date*</label>
                    <input type="text" class="form-control" id="startDate" wire:model="start" required>
                    @error('start') <span style="color: #8B0000">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 mt-4 mt-md-0">
                    <label class="form-label">End Date*</label>
                    <input type="text" class="form-control" id="endDate" wire:model="end" required>
                    @error('end') <span style="color: #8B0000">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 mt-4">
                    <label class="form-label">Number Of Days*</label>
                    <input type="text" class="form-control" wire:model="numOfDays" required>
                    @error('numOfDays') <span style="color: #8B0000">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 mt-4">
                    <label class="form-label">Resuming Work Date*</label>
                    <input type="text" class="form-control" id="endDate" wire:model="resume" required>
                    @error('resume') <span style="color: #8B0000">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 mt-4">
                    <div>
                        <label class="form-label">Leave Type*</label>
                    </div>
                    <div>
                        <select class="form-select" aria-label="Default select example" wire:model="leaveType">
                            <option value="">Select</option>
                            <option value="LEAVE WITHOUT PAY (LWOP)">LEAVE WITHOUT PAY (LWOP)</option>
                            <option value="LEAVE WITH PAY (LWP)">LEAVE WITH PAY (LWP)</option>
                        </select>
                        @error('leaveType') <span style="color: #8B0000">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-md-6 mt-4">
                    <label class="form-label">Reason*</label>
                    <textarea class="form-control" rows="2" wire:model="reason" style="border: none;" placeholder="Reason:"></textarea>
                    @error('reason') <span style="color: #8B0000">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- Emergency Contact --}}
            <div class="mt-4 row" x-data="{ selectedOptions: '' }">
                <div class="col-md-6">
                    <div>
                        <label class="form-label">Would you like to add emergency contact?</label>
                    </div>
                    <div>
                        <select class="form-select" aria-label="Default select example" wire:model="isEmergency" x-model="selectedOptions">
                            <option value="NO">NO</option>
                            <option value="YES">YES</option>
                        </select>
                        @error('isEmergency') <span style="color: #8B0000">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-md-6 mt-4 mt-md-4 mt-lg-0" x-show="selectedOptions === 'YES'">
                    <label class="form-label">Name*</label>
                    <input type="text" class="form-control" wire:model="name" :required="selectedOptions === 'YES'">
                    @error('name') <span style="color: #8B0000">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 mt-4" x-show="selectedOptions === 'YES'">
                    <label class="form-label">Address*</label>
                    <input type="text" class="form-control" wire:model="address" :required="selectedOptions === 'YES'">
                    @error('address') <span style="color: #8B0000">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 mt-4 mt-md-4" x-show="selectedOptions === 'YES'">
                    <label class="form-label">Phone Num.*</label>
                    <input type="text" class="form-control" wire:model="phoneNum" :required="selectedOptions === 'YES'">
                    @error('phoneNum') <span style="color: #8B0000">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 mt-4" x-show="selectedOptions === 'YES'">
                    <label class="form-label">Relationship*</label>
                    <input type="text" class="form-control" wire:model="relationship" :required="selectedOptions === 'YES'">
                    @error('relationship') <span style="color: #8B0000">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mt-4 row">
                <p class="fst-italic">
                    I {{$fullname}}. , thus declare that I have a leave of absence from my duties as stated above,
                    and I attest that this leave of absence is being sought for the stated purpose or purposes. I am aware
                    that in order to obtain a leave of absence from my employer, I must abide by the company's guidelines
                    and processes (and submit any additional supporting evidence, such as a medical certification, if
                    needed). I also understand that submitting a false form could result in disciplinary action, such as
                    termination or dismissal.
                </p>
            </div>

            <!-- Signature Pad -->
            <div class="mt-4 row">
                <label class="form-label">Signature*</label>
                <div class="col-sm-12">
                    <canvas id="signature-pad" style="width: 100%; height: 150px; background-color: white;"></canvas>
                    @error('signature') <span style="color: #8B0000">{{ $message }}</span> @enderror
                </div>
                <div class="col">
                    <button type="button" class="btn btn-danger" id="clear-signature">Clear</button>
                </div>
            </div>

            <hr>
            <div>
                <button type="button" class="btn btn-warning col-12 col-md-7" id="submit-signature">Submit</button>
                <button type="button" class="btn btn-primary mt-2 mt-md-0 col-12 col-md-4" wire:click="clear">Clear</button>
            </div>
        </form>
        <button id="btn123" data-bs-toggle="modal" data-bs-target="#loading" style="display: none"></button>
    </div>

    @script
    <script>
        $wire.on('success', () => {
            Swal.fire({
                title: 'Submitted!',
                text: 'Successfully Updated.',
                icon: 'success',
                allowOutsideClick: false,
                allowEscapeKey: false
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload();
                }
            });
        });
    </script>
    @endscript
</div>

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.6/dist/signature_pad.umd.min.js"></script>
    <script>
        function resizeCanvas(canvas, signaturePad) {
            const ratio = Math.max(window.devicePixelRatio || 1, 1);
            const width = canvas.offsetWidth;
            const height = canvas.offsetHeight;

            canvas.width = width * ratio;
            canvas.height = height * ratio;
            canvas.getContext("2d").scale(ratio, ratio);
        }

        document.addEventListener('DOMContentLoaded', function () {
            const canvas = document.getElementById('signature-pad');

            const signaturePad = new SignaturePad(canvas, {
                penColor: 'black'
            });

            // Resize and scale canvas
            resizeCanvas(canvas, signaturePad);

            // Handle resize
            window.addEventListener("resize", () => resizeCanvas(canvas, signaturePad));

            // Clear signature
            document.getElementById('clear-signature').addEventListener('click', function () {
                signaturePad.clear();
            });

            // Submit button
            document.getElementById('submit-signature').addEventListener('click', function () {
                // Get all required inputs by their IDs or querySelector
                const startDate = document.getElementById('startDate').value.trim();
                const endDate = document.getElementById('endDate').value.trim();
                const numOfDays = document.querySelector('[wire\\:model="numOfDays"]').value.trim();
                const leaveType = document.querySelector('[wire\\:model="leaveType"]').value.trim();
                const reason = document.querySelector('[wire\\:model="reason"]').value.trim();
                const isEmergency = document.querySelector('[wire\\:model="isEmergency"]').value.trim();

                // Additional fields only if Emergency is YES
                let name = '', address = '', phoneNum = '', relationship = '';
                if (isEmergency === 'YES') {
                    name = document.querySelector('[wire\\:model="name"]').value.trim();
                    address = document.querySelector('[wire\\:model="address"]').value.trim();
                    phoneNum = document.querySelector('[wire\\:model="phoneNum"]').value.trim();
                    relationship = document.querySelector('[wire\\:model="relationship"]').value.trim();
                }

                // Validate inputs
                if (
                    !startDate || !endDate || !numOfDays || !leaveType || !reason || !isEmergency ||
                    (isEmergency === 'YES' && (!name || !address || !phoneNum || !relationship))
                ) {
                    Swal.fire({
                        title: 'Incomplete Form',
                        text: 'Please fill out all required fields before signing.',
                        icon: 'warning',
                    });
                    return; // stop here if not complete
                }

                // Check if start date is greater than end date
                const start = new Date(startDate);
                const end = new Date(endDate);
                if (start > end) {
                    Swal.fire({
                        title: 'Invalid Dates',
                        text: 'The start date cannot be greater than the end date.',
                        icon: 'error',
                    });
                    return;
                }

                // Check if signature is empty
                if (signaturePad.isEmpty()) {
                    Swal.fire({
                        title: 'Missing Signature',
                        text: 'Please provide your signature before submitting.',
                        icon: 'warning',
                    });
                    return;
                }

                // Show signature confirmation
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you confirm this as your signature?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, submit it!',
                    cancelButtonText: 'No, go back'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const signatureData = signaturePad.toDataURL();
                        Livewire.dispatch('setSignature', { data: signatureData });
                    }
                });
            });

        });
    </script>
@endpush
