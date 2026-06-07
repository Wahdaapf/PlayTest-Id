@php
    use App\Models\UserBalance;

    $userId = $getRecord()->id_user;
    $balance = UserBalance::where('id_user', $userId)->first();
    $badgeCount = $balance->badge ?? 0;

    if ($badgeCount <= 5) {
        $tier = 'Beginner';
        $icon = '🔵';
        $color = 'rgb(59, 130, 246)';
    } elseif ($badgeCount <= 50) {
        $tier = 'Intermediate';
        $icon = '🟡';
        $color = 'rgb(217, 119, 6)';
    } else {
        $tier = 'Master';
        $icon = '🟣';
        $color = 'rgb(124, 58, 237)';
    }
@endphp

<span class="fi-badge" style="
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 3px 10px;
    border-radius: 9999px;
    font-size: 11px;
    font-weight: 600;
    color: {{ $color }};
    background-color: color-mix(in srgb, {{ $color }} 12%, transparent);
    border: 1px solid color-mix(in srgb, {{ $color }} 30%, transparent);
    white-space: nowrap;
">
    {{ $icon }} {{ $tier }}
</span>
