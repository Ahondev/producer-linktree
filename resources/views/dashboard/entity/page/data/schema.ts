import { z } from 'zod'

// We're keeping a simple non-relational schema here.
// IRL, you will have a schema for your data models.
export const campaignSchema = z.object({
    id: z.string(),
    name: z.string(),
    link: z.string(),
})

export type Review = z.infer<typeof campaignSchema>
