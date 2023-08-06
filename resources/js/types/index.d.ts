export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
    midle_name: string;
    first_last_name: string;
    second_last_name: string;
    password: string;
}

export interface Role {
    id: number;
    name: string;
    display_name: string;
    description: string;
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>
> = T & {
    auth: {
        user: User;
    };
};

export type RolePageProps<
    T extends Record<string, unknown> = Record<string, unknown>
> = T & {
    auth: {
        user: User;
    };
    roles: Role[];
};
