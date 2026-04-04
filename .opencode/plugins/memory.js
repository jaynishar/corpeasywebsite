import { writeFileSync, readFileSync, existsSync } from "fs"
import { join } from "path"

export const MemoryPlugin = async ({ project, client, $, directory, worktree }) => {
  const memoryPath = join(directory, "MEMORY.md")
  const today = new Date().toISOString().split("T")[0]
  let trackedChanges = new Set()

  return {
    "file.edited": async ({ event }) => {
      // Track which files were modified this session
      if (event.filePath && !event.filePath.includes("MEMORY.md")) {
        trackedChanges.add(event.filePath)
      }
    },

    "session.idle": async ({ event }) => {
      // Session went idle (user stopped interacting or closed)
      // Auto-update MEMORY.md with what happened
      if (!existsSync(memoryPath)) return

      try {
        let content = readFileSync(memoryPath, "utf-8")

        // Build summary of changes
        const changes = Array.from(trackedChanges)
        if (changes.length === 0) return

        const dateHeader = `### ${today} — Auto-saved Session Changes`
        const changeList = changes.map(f => `- Modified: ${f}`).join("\n")
        const entry = `\n${dateHeader}\n${changeList}\n- Auto-saved by MemoryPlugin on session idle\n`

        // Check if today's entry already exists
        if (!content.includes(dateHeader)) {
          // Find the Session Log section and append
          const sessionLogIndex = content.indexOf("## Session Log")
          if (sessionLogIndex !== -1) {
            const insertPoint = content.indexOf("\n", sessionLogIndex + 13)
            content = content.slice(0, insertPoint) + entry + content.slice(insertPoint)
          }

          // Update last updated date
          content = content.replace(
            /Project State \(Last Updated: .+?\)/,
            `Project State (Last Updated: ${today})`
          )

          writeFileSync(memoryPath, content, "utf-8")
        }
      } catch (err) {
        // Silently fail - don't break the session
      }
    },
  }
}
