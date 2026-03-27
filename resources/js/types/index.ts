export * from './auth';
export * from './navigation';
export * from './ui';

export interface CachedFile {
    uri: string;
    index: string | null;
    amp: string | null;
}

export interface ResourcePaginator<T> {
    data: T[];
    links: {
        first: string;
        last: string;
        prev: string | null;
        next: string | null;
    };
    meta: {
        current_page: number;
        from: number | null;
        last_page: number;
        links: {
            active: boolean;
            label: string;
            url: string | null;
        }[];
        path: string;
        per_page: number;
        to: number | null;
        total: number;
    };
}

export interface User {
    id: number;
    name: string;
    email: string;
    created_at: string | null;
    updated_at: string | null;
}
