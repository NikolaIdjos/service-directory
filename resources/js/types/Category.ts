import { Provider } from '@/types/Provider';

export interface Category {
    id: number;
    name: string;
    providers: Provider[];
}
