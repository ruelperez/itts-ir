<div style="display: flex;
    justify-content: center; /* Centers horizontally */
    align-items: center;     /* Centers vertically */
    height: 100vh;           /* Full viewport height */
    text-align: center;      /* Center the text */
    flex-direction: column;  /* Stack items vertically */">
    <h3>Employee ID: {{ $employeeId }}</h3>
    <div>{!! $qrCode !!}</div>
</div>
