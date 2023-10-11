export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
    midle_name: string;
    first_last_name: string;
    second_last_name: string;
    password: string;
    role_name?: string;
}

export interface StatusForm {
    id?: number;
    name: string;
}

export interface Customer extends User {}

export interface Role {
    id: number;
    name: string;
    display_name: string;
    description: string;
    is_deletetable: boolean;
}

export interface FormDocInrteface {
    id?: number;
    name: string;
}

export interface UserFormRequest {
    customer: Customer;
    status: StatusForm;
    doc: FormDocInrteface;
    form_quests_page: [key: string, value: string];
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>
> = T & {
    auth: {
        user: User;
    };
    errorHandlerMessage: string;
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

export type ListIndexRequestPageProps<
    T extends Record<string, unknown> = Record<string, unknown>
> = T & {
    requests: UserFormRequest[];
};
