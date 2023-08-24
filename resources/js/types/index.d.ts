export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
    midle_name: string;
    first_last_name: string;
    second_last_name: string;
    password: string;
    role?: Role
}

export interface Role {
    id: number;
    name: string;
    display_name: string;
    description: string;
    is_deletetable: boolean
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>
> = T & {
    auth: {
        user: User;
    };
    errorHandlerMessage: string
};

export type RolePageProps<
    T extends Record<string, unknown> = Record<string, unknown>
> = T & {
    auth: {
        user: User;
    };
    roles: Role[];
};

export type NewRolePageProps<
    T extends Record<string, unknown> = Record<string, unknown>
> = T & {
    auth: {
        user: User;
    };
    role?: Role;
};


export type IndexUserPageProps<
    T extends Record<string, unknown> = Record<string, unknown>
> = T & {
    auth: {
        user: User;
    };
    users: User[];
};


export type NewEditUserPageProps<
    T extends Record<string, unknown> = Record<string, unknown>
> = T & {
    auth: {
        user: User;
    };
    user?: User;
    roles: Role[];
};
