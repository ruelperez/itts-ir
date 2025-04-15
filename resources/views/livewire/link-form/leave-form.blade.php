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
            <div class="mt-4 row">
                <label class="form-label">Signature*</label>
                <div class="col-sm-12">
                    <canvas id="signature-pad" class="signature-pad w-100" height="75" style="background-color: white"></canvas>
                    @error('signature') <span style="color: #8B0000">{{ $message }}</span> @enderror
                </div>
                <div class="col">
                    <button type="button" class="btn btn-danger" id="clear-signature">Clear</button>
                </div>
            </div>

            <hr>
            <div>
                <button type="submit" class="btn btn-warning col-12 col-md-7" id="submit-signature">Submit</button>
                <button type="button" class="btn btn-primary mt-2 mt-md-0 col-12 col-md-4" wire:click="clear">Clear</button>
            </div>
        </form>
        <button id="btn123" data-bs-toggle="modal" data-bs-target="#loading" style="display: none"></button>
    </div>
    @script
    <script>
        $wire.on('success', () => {
            Swal.fire({
                title: 'Updated!',
                text: 'Successfully Updated.',
                icon: 'success',
                allowOutsideClick: false,  // Prevent closing by clicking outside
                allowEscapeKey: false      // Prevent closing with ESC
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload(); // Reload the page after clicking OK
                }
            });
        });
    </script>
    @endscript
</div>
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.6/dist/signature_pad.umd.min.js"></script>
    <script>
        // // Initialize Signature Pad
        // const canvas = document.getElementById('signature-pad');
        // const signaturePad = new SignaturePad(canvas);
        //
        // // Clear Signature
        // document.getElementById('clear-signature').addEventListener('click', function () {
        //     signaturePad.clear();
        // });
        //
        // // Capture signature when form is submitted
        // document.querySelector('form').addEventListener('submit', function (e) {
        //     if (signaturePad.isEmpty()) {
        //         e.preventDefault();
        //         alert('Please provide a signature.');
        //     } else {
        //         // Convert signature to base64 and set it to Livewire model
        //     @this.set('signature', signaturePad.toDataURL());
        //     }
        // });


        // const canvas = document.getElementById('signature-pad');
        // console.log('Canvas:', canvas);
        //
        // const signaturePad = new SignaturePad(canvas);
        // console.log('SignaturePad initialized.');
        //
        // document.getElementById('clear-signature').addEventListener('click', function () {
        //     signaturePad.clear();
        //     console.log('Signature cleared.');
        // });
        //
        // document.querySelector('form').addEventListener('submit', function (e) { console.log('qq');
        //     if (signaturePad.isEmpty()) {
        //         e.preventDefault();
        //         alert('Please provide a signature.');
        //         console.log('Form blocked, signature is empty.');
        //     } else {
        //         const signatureData = signaturePad.toDataURL();
        //         console.log('Captured signature:', signatureData);
        //     @this.set('signature', signatureData);
        //     }
        // });


            document.addEventListener('DOMContentLoaded', function () {
            const canvas = document.getElementById('signature-pad');
            const signaturePad = new SignaturePad(canvas);

            // Clear button
            document.getElementById('clear-signature').addEventListener('click', function () {
            signaturePad.clear();
        });

            // Submit button
            document.getElementById('submit-signature').addEventListener('click', function () {
            if (signaturePad.isEmpty()) {
            alert('Please provide a signature.');
        } else {
            const signatureData = signaturePad.toDataURL();
            console.log('Captured signature:', signatureData);

            // Send signature to Livewire component
            Livewire.dispatch('setSignature', { data: signatureData });
        }
        });
        });


    </script>

@endpush
