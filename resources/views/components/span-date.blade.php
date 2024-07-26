@props(['date'])
<span {{ $attributes->merge([ 'class' => 'tracking-[0.10rem]']) }}>{{ $date ? \Carbon\Carbon::parse($date)->tz('America/Sao_Paulo')->format('d/m/Y') : ''}}</span>
