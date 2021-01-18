<div class="relative flex flex-horizontal flex-end px-6 pt-8">
    @if(Route::current()->getName() != 'home')
        <a href="{{ route('home') }}" class="menu-item">Scan PDF</a>
    @endif
    @if(Route::current()->getName() != 'borowwer')
        <a href="{{ route('borowwer') }}" class="menu-item">Borrower Docusign</a>
    @endif
    @if(Route::current()->getName() != 'smartapp')
        <a href="{{ route('smartapp') }}" class="menu-item">SmartApp 1003</a>
    @endif
</div>
