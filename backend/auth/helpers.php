<?php

function storeUserRoleInSession(?string $roleName): void
{
    if (!$roleName) {
        $_SESSION['user_role'] = null;
        return;
    }

    $normalized = str_contains($roleName, ' ')
        ? strtolower(str_replace(' ', '_', $roleName))
        : strtolower($roleName);

    $_SESSION['user_role'] = $normalized;
}

function slugToTitle(string $slug): string {
    return ucwords(str_replace('-', ' ', $slug));
}
