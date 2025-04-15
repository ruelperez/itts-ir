<div>
    <div>
        <h5>Leave Form</h5>
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
                <div class="col-md-6 mt-4 mt-md-0" x-show="selectedOptions === 'YES'">
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
            <div class="col-md-12 mt-4">
                <label class="form-label">E-Signature*</label>
                <div style="border: 1px solid #ccc;">
                    <canvas id="signature-pad" class="w-100" style="background-color: white; height: 200px;"></canvas>
                </div>
                <button type="button" class="btn btn-sm btn-secondary mt-2" onclick="clearSignature()">Clear Signature</button>
                <input type="hidden" id="signature" wire:model="signature">
                @error('signature') <span style="color: #8B0000">{{ $message }}</span> @enderror
            </div>
            <hr>
            <div>
                <button type="submit" class="btn btn-warning col-12 col-md-7">Submit</button>
                <button type="button" class="btn btn-primary mt-2 mt-md-0 col-12 col-md-4" wire:click="clear">Clear</button>
            </div>
        </form>
        <button id="btn123" data-bs-toggle="modal" data-bs-target="#loading" style="display: none"></button>
    </div>
</div>

@push('js')

    <script>
        window.addEventListener('signature-missing', () => {
            Swal.fire({
                icon: 'warning',
                title: 'Missing Signature',
                text: 'Please provide your e-signature before submitting.',
            });
        });
        document.addEventListener('DOMContentLoaded', () => {
            const canvas = document.getElementById('signature-pad');
            const livewireComponent = Livewire.find(document.querySelector('[wire\\:id]').getAttribute('wire:id'));

            const signaturePad = new SignaturePad(canvas, {
                penColor: 'black'
            });

            // Function to resize the canvas based on window size
            function resizeCanvas() {
                const ratio = Math.max(window.devicePixelRatio || 1, 1);
                canvas.width = canvas.offsetWidth * ratio;
                canvas.height = canvas.offsetHeight * ratio;
                canvas.style.width = canvas.offsetWidth + 'px';
                canvas.style.height = canvas.offsetHeight + 'px';
                const ctx = canvas.getContext("2d");
                ctx.scale(ratio, ratio);
            }

            // Resize the canvas immediately and on window resize
            resizeCanvas();
            window.addEventListener('resize', resizeCanvas);

            // Event listener for when drawing ends
            signaturePad.onEnd = function () {
                const data = signaturePad.toDataURL();
                console.log("Signature data:", data);  // Log the signature data to the console
                livewireComponent.set('signature', data);
            };

            // Function to clear the signature
            window.clearSignature = function () {
                signaturePad.clear();
                livewireComponent.set('signature', null);
            };
        });
    </script>
@endpush

