@props(['number'])
<span {{ $attributes->merge([ 'class' => 'tracking-[0.10rem]']) }}>{{ Number::spell($number, 'br') ?? '' }} reais</span>
