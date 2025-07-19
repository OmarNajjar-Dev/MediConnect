<?php

// Store normalized role in session (snake_case)
function storeUserRoleInSession(?string $roleName): void
{
    if (!$roleName) {
        $_SESSION['user_role'] = null;
        return;
    }

    $_SESSION['user_role'] = slugToSnakeCase($roleName);
}

// Convert slug (e.g. "super-admin") to readable title (e.g. "Super Admin")
function slugToTitle(string $slug): string {
    return ucwords(str_replace('-', ' ', $slug));
}

// Convert any slug or role name to snake_case
function slugToSnakeCase(string $slugOrTitle): string {
    // Replace spaces and dashes with underscore, then lowercase
    return strtolower(str_replace([' ', '-'], '_', $slugOrTitle));
}