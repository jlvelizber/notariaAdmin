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
    role?: Role;
    country_id?: number;
    identification_num?: string;
    country?: Country;
}

export interface Country {
    id: number;
    name: string;
}

export interface StatusForm {
    id?: number;
    name: string;
    code: string;
}

export interface Customer extends User { }

export interface Role {
    id: number;
    name: string;
    display_name: string;
    description: string;
    is_deletetable: boolean;
}

export interface DocFormFieldOptions {
    value: string;
    label: string;
}
export interface DocFormFieldValidator {
    required?: boolean;
}

export interface DocFormField {
    label: string;
    type: string;
    name: string;
    value?: string;
    options?: DocFormFieldOptions[];
    validations?: DocFormFieldValidator;
}

export interface SectionDocFormField {
    name?: string;
    fields: DocFormField[];
}

export interface DocFormType {
    name: string;
    display_name: string;
    route_name: string;
}

export interface FormDocInrteface {
    id?: number;
    name: string;
    code_name: string;
    field_requests: SectionDocFormField[];
    body: string;
    form_type_id: number;
    category: DocFormType
}

export interface UserFormRequest {
    id: number;
    customer: Customer;
    status: StatusForm;
    doc: FormDocInrteface;
    form_request_body: { key: string; value: string };
    logs?: HistoryLogInterface[];
}

export interface ConfigurationInterface {
    id: number;
    parent_id?: number;
    key?: string;
    label: string;
    value: string;
}

/**
 * Esto es lo que viene desde el Share
 */
export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>
> = T & {
    auth: {
        user: User;
        permissions: {
            can_access_roles: true,
            can_access_users: true,
            can_access_requests: true,
            can_access_settings: true,
        }
    };
    form_types: DocFormType[]
    top_configurations: ConfigurationInterface[]
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

export type ListEditShowRequestPageProps<
    T extends Record<string, unknown> = Record<string, unknown>
> = T & {
    request: UserFormRequest;
};

export type ListIndexConfigurationPageProps<
    T extends Record<string, unknown> = Record<string, unknown>
> = T & {
    configurations: ConfigurationInterface[];
};

export interface HistoryLogInterface {
    form_request_id: number;
    user_id: number;
    action: string;
    description: string;
    user?: User
}

export type EditConfigurationPageProps<
    T extends Record<string, unknown> = Record<string, unknown>
> = T & {
    configuration: ConfigurationInterface;
};
