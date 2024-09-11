import type { ColumnDef } from '@tanstack/vue-table'
import { Checkbox } from '@shadcn/components/ui/checkbox'
import { h } from "vue";

// This type is used to define the shape of our data.
// You can use a Zod schema here if you want.
export interface Campaign {
    id: number
    name: string
    link: string
    views: number
}

export const columns: ColumnDef<Campaign>[] = [
    {
        id: 'select',
        header: ({ table }) => h(Checkbox, {
            'checked': table.getIsAllPageRowsSelected(),
            'onUpdate:checked': (value: boolean) => table.toggleAllPageRowsSelected(!!value),
            'ariaLabel': 'Select all',
        }),
        cell: ({ row }) => h(Checkbox, {
            'checked': row.getIsSelected(),
            'onUpdate:checked': (value: boolean) => row.toggleSelected(!!value),
            'ariaLabel': 'Select row',
        }),
        enableSorting: false,
        enableHiding: false,
    },
    {
        accessorKey: 'id',
        header: 'ID',
    },
    {
        accessorKey: 'name',
        header: 'Campaign name',
        cell: ({ row }) => {
            return h('a', {
                href: `/dashboard/campaigns/${row.getValue('link')}`,
                class: 'font-semibold'
            }, row.getValue('name'));
        }
    },
    {
        accessorKey: 'link',
        header: 'Campaign link',
        cell: ({ row }) => { return `https://${window.env.APP_DOMAIN}/${row.getValue('link')}` },
    },
    {
        accessorKey: 'views',
        header: 'Vues',
        cell: ({ row }) => { return row.getValue('views') },
    },
]
