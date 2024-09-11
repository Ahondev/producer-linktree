import { Component, h, VNode } from 'vue';
import SpotifyIcon from "../../../components/icons/SpotifyIcon.vue";
import DeezerIcon from "../../../components/icons/DeezerIcon.vue";
import AppleMusicIcon from "../../../components/icons/AppleMusicIcon.vue";
import SoundcloudIcon from "../../../components/icons/SoundcloudIcon.vue";

// Define the type for each link item
export interface LinkItemInterface {
    platform: string;
    url: string;
}

// Define the type for the links object
// export interface LinksInterface {
//     [key: string]: LinkItemInterface;
// }
//
// // Create the links object with proper types
// export const links: LinksInterface = {
//     spotify: {
//         name: 'Spotify',
//         icon: SpotifyIcon,
//     },
//     deezer: {
//         name: 'Deezer',
//         icon: DeezerIcon,
//     },
//     apple_music: {
//         name: 'Apple Music',
//         icon: AppleMusicIcon,
//     },
//     soundcloud: {
//         name: 'Soundcloud',
//         icon: SoundcloudIcon,
//     },
// };
