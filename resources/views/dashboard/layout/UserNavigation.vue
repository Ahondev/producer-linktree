<template>
    <DropdownMenu>
        <DropdownMenuTrigger as-child>
            <Button variant="ghost" class="relative h-8 w-8 rounded-full !ml-auto">
                <Avatar class="h-9 w-9">
                    <AvatarImage src="/avatars/03.png" alt="@shadcn" />
                    <AvatarFallback>A</AvatarFallback>
                </Avatar>
            </Button>
        </DropdownMenuTrigger>
        <DropdownMenuContent class="w-56" align="end">
            <DropdownMenuLabel class="font-normal flex">
                <div class="flex flex-col space-y-1">
                    <p class="text-sm font-medium leading-none">
                        {{ user.name }}
                    </p>
                    <p class="text-xs leading-none text-muted-foreground">
                        {{ user.email }}
                    </p>
                </div>
            </DropdownMenuLabel>
            <DropdownMenuSeparator />
            <DropdownMenuGroup>
                <DropdownMenuItem>
                    Profile
                    <DropdownMenuShortcut>⇧⌘P</DropdownMenuShortcut>
                </DropdownMenuItem>
<!--                <DropdownMenuItem>-->
<!--                    Billing-->
<!--                    <DropdownMenuShortcut>⌘B</DropdownMenuShortcut>-->
<!--                </DropdownMenuItem>-->
                <DropdownMenuItem>
                    Paramètres
                    <DropdownMenuShortcut>⌘S</DropdownMenuShortcut>
                </DropdownMenuItem>
<!--                <DropdownMenuItem>New Team</DropdownMenuItem>-->
            </DropdownMenuGroup>
            <DropdownMenuSeparator />
            <DropdownMenuItem @click="logout()">
                Se déconnecter
                <DropdownMenuShortcut>⇧⌘Q</DropdownMenuShortcut>
            </DropdownMenuItem>
        </DropdownMenuContent>
    </DropdownMenu>
</template>

<script>
import {
    Avatar,
    AvatarFallback,
    AvatarImage,
} from '@shadcn/components/ui/avatar'
import { Button } from '@shadcn/components/ui/button'
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuGroup,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuShortcut,
    DropdownMenuTrigger,
} from '@shadcn/components/ui/dropdown-menu'
import { redirect, request } from "../../../js/http/request.js";
export default {
    components: {
        DropdownMenu,
        DropdownMenuContent,
        DropdownMenuGroup,
        DropdownMenuItem,
        DropdownMenuLabel,
        DropdownMenuSeparator,
        DropdownMenuShortcut,
        DropdownMenuTrigger,
        Avatar,
        AvatarFallback,
        AvatarImage,
        Button
    },
    data () { return {
        user: window.user
    }},
    methods: {
        async logout() {
            request(axios.post, "/logout").then((r) => { redirect("/") })
        }
    }
}
</script>
