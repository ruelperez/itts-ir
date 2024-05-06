<div>
    <div x-data="{ interval: null }" x-init="interval = setInterval(() => { @this.call('updateTime') }, 1000)">
        <h1 style="color: white">{{ $time }}</h1>
    </div>
</div>
