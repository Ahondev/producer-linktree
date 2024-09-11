import { LinkItemInterface } from "../../link/data/enum";

export interface ContentInterface {
    title: string;
    image: File;
    text: string;
    links: Record<string, LinkItemInterface>
}

export interface AppearanceInterface {
    backgroundType: 'color-simple' | 'color-gradient' | 'media-image';
    color?: string;
    gradient?: string;
    image?: File;
    theme: 'dark' | 'light';
}
